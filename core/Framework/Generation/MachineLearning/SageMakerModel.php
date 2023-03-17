<?php

use Aws\SageMaker\SageMakerClient;
use Aws\Exception\AwsException;

class SageMakerModel
{
    protected $modelCriteria;
    protected $sagemaker;

    public function __construct(ModelCriteria $modelCriteria)
    {
        $this->modelCriteria = $modelCriteria;

        $this->sagemaker = new SageMakerClient([
            'version' => 'latest',
            'region' => 'us-west-2', // Change this to your preferred region
            'credentials' => [
                'key' => 'YOUR_AWS_ACCESS_KEY',
                'secret' => 'YOUR_AWS_SECRET_KEY',
            ],
        ]);
    }

    public function createModel()
    {
        $modelName = $this->modelCriteria->getModelName();
        $executionRoleArn = 'arn:aws:iam::xxxxxxxxxxxx:role/service-role/AmazonSageMaker-ExecutionRole-xxxxxxxxxxxx'; // Update this with your actual execution role ARN
        $primaryContainer = [
            'Image' => 'xxxxxxx.dkr.ecr.us-west-2.amazonaws.com/your-container-image:latest', // Update this with your actual container image
            'ModelDataUrl' => 's3://your-bucket/your-path/model.tar.gz', // Update this with your actual model data URL
            'Environment' => [
                'SAGEMAKER_REGION' => 'us-west-2', // Change this to your preferred region
            ],
        ];

        try {
            $result = $this->sagemaker->createModel([
                'ModelName' => $modelName,
                'ExecutionRoleArn' => $executionRoleArn,
                'PrimaryContainer' => $primaryContainer,
            ]);

            echo "Model created: {$result['ModelArn']}" . PHP_EOL;
            return $result['ModelArn'];
        } catch (AwsException $e) {
            echo "Error creating model: " . $e->getMessage() . PHP_EOL;
            return null;
        }
    }

    public function trainModel()
    {
        $jobName = $this->modelCriteria->getTrainingJobName();
        $modelName = $this->modelCriteria->getModelName();
        $executionRoleArn = 'arn:aws:iam::xxxxxxxxxxxx:role/service-role/AmazonSageMaker-ExecutionRole-xxxxxxxxxxxx'; // Update this with your actual execution role ARN
        $algorithmSpecification = [
            'TrainingImage' => 'xxxxxxx.dkr.ecr.us-west-2.amazonaws.com/your-container-image:latest', // Update this with your actual container image
            'TrainingInputMode' => 'File',
        ];
        $inputDataConfig = [
            [
                'ChannelName' => 'train',
                'DataSource' => [
                    'S3DataSource' => [
                        'S3DataType' => 'S3Prefix',
                        'S3Uri' => 's3://your-bucket/your-path/train/', // Update this with your actual training data location
                        'S3DataDistributionType' => 'FullyReplicated',
                    ],
                ],
            ],
            [
                'ChannelName' => 'validation',
                'DataSource' => [
                    'S3DataSource' => [
                        'S3DataType' => 'S3Prefix',
                        'S3Uri' => 's3://your-bucket/your-path/validation/', // Update this with your actual validation data location
                        'S3DataDistributionType' => 'FullyReplicated',
                    ],
                ],
            ],
        ];
        $outputDataConfig = [
            'S3OutputPath' => 's3://your-bucket/your-path/output/', // Update this with your actual output data location
        ];
        $resourceConfig = [
            'InstanceType' => 'ml.m5.large', // Change this based on your preference
            'InstanceCount' => 1,
            'VolumeSizeInGB' => 50,
        ];
        $stoppingCondition = [
            'MaxRuntimeInSeconds' => 86400, // 1 day, adjust as needed
        ];

        try {
            $result = $this->sagemaker->createTrainingJob([
                'TrainingJobName' => $jobName,
                'AlgorithmSpecification' => $algorithmSpecification,
                'RoleArn' => $executionRoleArn,
                'InputDataConfig' => $inputDataConfig,
                'OutputDataConfig' => $outputDataConfig,
                'ResourceConfig' => $resourceConfig,
                'StoppingCondition' => $stoppingCondition,
            ]);

            echo "Training job created: {$jobName}" . PHP_EOL;
            return $jobName;
        } catch (AwsException $e) {
            echo "Error creating training job: " . $e->getMessage() . PHP_EOL;
            return null;
        }
    }

    public function deployModel()
    {
        $modelName = $this->modelCriteria->getModelName();
        $endpointConfigName = $modelName . '-config';
        $endpointName = $modelName . '-endpoint';
        $productionVariants = [
            [
                'VariantName' => 'AllTraffic',
                'ModelName' => $modelName,
                'InitialInstanceCount' => 1,
                'InstanceType' => 'ml.m5.large', // Change this based on your preference
            ],
        ];

        try {
            // Create the endpoint configuration
            $result = $this->sagemaker->createEndpointConfig([
                'EndpointConfigName' => $endpointConfigName,
                'ProductionVariants' => $productionVariants,
            ]);

            echo "Endpoint configuration created: {$result['EndpointConfigArn']}" . PHP_EOL;

            // Create the endpoint
            $result = $this->sagemaker->createEndpoint([
                'EndpointName' => $endpointName,
                'EndpointConfigName' => $endpointConfigName,
            ]);

            echo "Endpoint created: {$result['EndpointArn']}" . PHP_EOL;
            return $result['EndpointArn'];
        } catch (AwsException $e) {
            echo "Error deploying model: " . $e->getMessage() . PHP_EOL;
            return null;
        }
    }

    /*
     * Keep in mind that deploying a model can take several minutes to complete. 
     * To check the status of the endpoint creation, you can use the describeEndpoint 
     * method of the SageMakerClient
     */
    public function checkEndpointStatus($endpointName)
    {
        try {
            $result = $this->sagemaker->describeEndpoint([
                'EndpointName' => $endpointName,
            ]);

            $status = $result['EndpointStatus'];
            echo "Endpoint status: {$status}" . PHP_EOL;
            return $status;
        } catch (AwsException $e) {
            echo "Error checking endpoint status: " . $e->getMessage() . PHP_EOL;
            return null;
        }
    }

}
