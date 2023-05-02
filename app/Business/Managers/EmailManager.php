<?php

namespace App\Business\Managers;

use BlueFission\Services\Service;
use App\Domain\Email\Email;
use App\Domain\Email\EmailAccount;
use App\Domain\Email\Repositories\IEmailRepository;

class EmailManager extends Service
{
    protected $repo;
    protected $emailAccounts;

    public function __construct(IEmailRepository $repo)
    {
        $link->open();
        $this->repo = $repo;
        $this->emailAccounts = [];

        parent::__construct();
    }

    public function addEmailAccount(EmailAccount $account)
    {
        $this->emailAccounts[] = $account;
    }

    // Basic CRUD methods for the emails table.
    public function compose(Email $email)
    {
        $this->repo->save($email);
    }

    public function send($email_id)
    {
        $email = $this->read($email_id);
        // Choose the appropriate email account based on the email
        $account = $this->resolveEmailAccount($email);
        
        if ($account) {
            // Send the email using the chosen email account
            $account->send($email);

            // Update the email status to 'sent'
            $email->status = Email::SENT;
            $this->update($email);
        }
    }

    public function read($email_id)
    {
        return $this->repo->find($email_id);
    }

    public function update(Email $email)
    {
        if ($email->email_id) {
            $this->repo->save($email);
        }
    }

    public function delete($email_id)
    {
        $this->repo->remove($email_id);
    }

    public function list($account = null)
    {
        // Aggregate emails from all accounts or just the specified account
        $emails = [];
        foreach ($this->emailAccounts as $emailAccount) {
            if (!$account || $account == $emailAccount) {
                $emails = array_merge($emails, $emailAccount->listEmails());
            }
        }
        return $emails;
    }

    protected function resolveEmailAccount(Email $email)
    {
        // Choose the appropriate email account based on the email's "from" address
        foreach ($this->emailAccounts as $account) {
            if ($account->emailAddressMatches($email->from)) {
                return $account;
            }
        }
        return null;
    }
}
