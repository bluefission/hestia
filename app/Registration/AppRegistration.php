<?php
namespace App\Registration;
// use App\Business\Managers\CommandManager;
use App\Business\Managers\NavMenuManager;
use App\Business\Managers\DatasourceManager;
use App\Business\Managers\AddOnManager;
use App\Business\Managers\InterpretationManager;
use App\Business\Managers\CommunicationManager;
use App\Business\Managers\ConversationManager;
use App\Business\Managers\ThreadManager;
use App\Business\Managers\SkillManager;
use App\Business\Services\OpenAIService;
use App\Business\Services\OpenWeatherService;
use App\Business\Services\LocationService;
use App\Business\MysqlConnector;
use BlueFission\BlueCore\Skill\Intent\Matcher;
use BlueFission\BlueCore\Theme;
use BlueFission\BlueCore\IExtension;
// For Conversations
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

/**
 * Class AppRegistration
 *
 * This class contains logic for registering different components and dependencies in the application
 *
 * @package App\Registration
 */
class AppRegistration implements IExtension {
	/**
	 * The instance of the app
	 *
	 * @var object
	 */
	private $_app;
	
	/**
	 * The name of the app
	 *
	 * @var string
	 */
	private $_name = "Application Main";
	
	/**
	 * AppRegistration constructor.
	 */
	public function __construct() {
		$this->_app = \App::instance();
	}

	/**
	 * Get the name of the app
	 *
	 * @return string
	 */
	public function name() {
		return $this->_name;
	}

	/**
	 * Initialize the registrations
	 */
	public function init() {
		$this->bindings();
		$this->arguments();
		$this->registrations();
		$this->themes();
		$this->addons();
	}

	/**
	 * Register different components in the app
	 */
	public function registrations() {
		// Check if running in command line or via HTTP
		$isCommandLine = (php_sapi_name() === 'cli');
		// Register the appropriate driver based on the environment
		if ($isCommandLine) {
			DriverManager::loadDriver(\App\Business\Console\BotMan\CommandLineDriver::class);
		} else {
		    DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
		}
		$adapter = new FilesystemAdapter();
		$cache = new SymfonyCache($adapter);
		$botman = BotManFactory::create([], $cache);
		$this->_app->delegate('botman', $botman);

		$this->_app->delegate('communication', CommunicationManager::class);
		// $this->_app->delegate('cmd', CommandManager::class);
		$this->_app->delegate('nav', NavMenuManager::class);
		$this->_app->delegate('addons', AddOnManager::class);
		$this->_app->delegate('interpreter', InterpretationManager::class);
		$this->_app->delegate('convo', ConversationManager::class);
		$this->_app->delegate('thread', ThreadManager::class);
		$this->_app->delegate('skill', SkillManager::class);
		$this->_app->delegate('datasource', DatasourceManager::class);

		$this->_app->delegate('intentmatcher', Matcher::class);
		$this->_app->delegate('mysql', MysqlConnector::class);
		$this->_app->delegate('openai', OpenAIService::class);

		// TODO move these to addons
		$this->_app->delegate('openweather', OpenWeatherService::class);
		$this->_app->delegate('location', LocationService::class);
	}

	/**
	 * Bind different components with their respective implementations
	 */
	public function bindings() {
		$this->_app->bind('App\Domain\User\Queries\IAllUsersQuery', 'App\Domain\User\Queries\AllUsersQuerySql');
		$this->_app->bind('App\Domain\User\Queries\IAllCredentialStatusesQuery', 'App\Domain\User\Queries\AllCredentialStatusesQuerySql');
		$this->_app->bind('App\Domain\User\Repositories\IUserRepository', 'App\Domain\User\Repositories\UserRepositorySql');
		$this->_app->bind('App\Domain\User\Repositories\ICredentialRepository', 'App\Domain\User\Repositories\CredentialRepositorySql');

		$this->_app->bind('App\Domain\AddOn\Queries\IAllAddOnsQuery', 'App\Domain\AddOn\Queries\AllAddOnsQuerySql');
		$this->_app->bind('App\Domain\AddOn\Queries\IActivatedAddOnsQuery', 'App\Domain\AddOn\Queries\ActivatedAddOnsQuerySql');
		$this->_app->bind('App\Domain\AddOn\Repositories\IAddOnRepository', 'App\Domain\AddOn\Repositories\AddOnRepositorySql');

		$this->_app->bind('App\Domain\Content\Queries\IAllContentQuery', 'App\Domain\Content\Queries\AllContentQuerySql');
		$this->_app->bind('App\Domain\Content\Repositories\IContentRepository', 'App\Domain\Content\Repositories\ContentRepositorySql');

		$this->_app->bind('App\Domain\Communication\Repositories\ICommunicationRepository', 'App\Domain\Communication\Repositories\CommunicationRepositorySql');
		$this->_app->bind('App\Domain\Communication\Queries\IUndeliveredCommunicationsQuery', 'App\Domain\Communication\Queries\UndeliveredCommunicationsQuerySql');

		$this->_app->bind('BlueFission\Data\Storage\Storage', 'BlueFission\Data\Storage\MySQL');

		$this->_app->bind('BlueFission\Automata\Analysis\IAnalyzer', 'BlueFission\BlueCore\Skill\Intent\KeywordIntentAnalyzer');
		$this->_app->bind('App\Domain\Conversation\Repositories\ITopicRepository', 'App\Domain\Conversation\Repositories\TopicRepositorySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IDialoguesByTopicQuery', 'App\Domain\Conversation\Queries\DialoguesByTopicQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IDialoguesByKeywordsQuery', 'App\Domain\Conversation\Queries\DialoguesByKeywordsQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IMessagesByKeywordQuery', 'App\Domain\Conversation\Queries\MessagesByKeywordQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IMessagesByTimestampQuery', 'App\Domain\Conversation\Queries\MessagesByTimestampQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IMessagesByUserIdQuery', 'App\Domain\Conversation\Queries\MessagesByUserIdQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IMessagesQuery', 'App\Domain\Conversation\Queries\MessagesQuerySql');
		$this->_app->bind('App\Domain\Conversation\Repositories\IDialogueTypeRepository', 'App\Domain\Conversation\Repositories\DialogueTypeRepositorySql');
		$this->_app->bind('App\Domain\Conversation\Repositories\IDialogueRepository', 'App\Domain\Conversation\Repositories\DialogueRepositorySql');
		$this->_app->bind('App\Domain\Conversation\Repositories\IMessageRepository', 'App\Domain\Conversation\Repositories\MessageRepositorySql');
		$this->_app->bind('App\Domain\Conversation\Repositories\ILanguageRepository', 'App\Domain\Conversation\Repositories\LanguageRepositorySql');
		$this->_app->bind('App\Domain\Conversation\Queries\ITopicRoutesByTopicQuery', 'App\Domain\Conversation\Queries\TopicRoutesByTopicQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\ITagsByTopicQuery', 'App\Domain\Conversation\Queries\TagsByTopicQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IAllTopicsQuery', 'App\Domain\Conversation\Queries\AllTopicsQuerySql');
		$this->_app->bind('App\Domain\Conversation\Queries\IFactsByKeywordsQuery', 'App\Domain\Conversation\Queries\FactsByKeywordsQuerySql');
	}

	/**
	 * Pass arguments to different components
	 */
	public function arguments() {
		$this->_app->bindArgs( ['config'=>$this->_app->configuration('database')['mysql']], 'BlueFission\Connections\Database\MySQLLink');
		$this->_app->bindArgs( ['driverConfigurations'=>$this->_app->configuration('communication')['drivers']], 'App\Business\Managers\CommunicationManager');
		$this->_app->bindArgs( [
				'rules'=>$this->_app->configuration('nlp')['grammar']['rules'],
				'commands'=>$this->_app->configuration('nlp')['grammar']['commands'],
				'tokens'=>$this->_app->configuration('nlp')['dictionary']
			], 'BlueFission\Automata\Language\Grammar');
		$this->_app->bindArgs( ['modelDirPath'=>$this->_app->configuration('paths')['ml']['models']], 'BlueFission\Automata\Analysis\KeywordTopicAnalyzer');
		$this->_app->bindArgs( ['modelDirPath'=>$this->_app->configuration('paths')['ml']['models']], 'BlueFission\BlueCore\Skill\Intent\KeywordIntentAnalyzer');
		$this->_app->bindArgs( ['config'=>$this->_app->configuration('nlp')['roots']], 'BlueFission\Automata\Language\StemmerLemmatizer');
		$this->_app->bindArgs( ['storage'=>new \BlueFission\Data\Storage\Session(['location'=>'cache','name'=>'system'])], 'BlueFission\BlueCore\Command\CommandProcessor');
	}

	public function addons()
	{
		$addons = $this->_app->service('addons');
		$addons->loadActivatedAddOns();
	}

	public function themes()
	{
		$this->_app->addTheme(new Theme('app/default', 'default'));
		$this->_app->addTheme(new Theme('app/admin', 'admin'));
		$this->_app->addTheme(new Theme('app/bluefission', 'bluefission'));
	}
}