<?php


namespace App\Services\SMSService;


use App\Services\SMSService\SMSLoger\SMSlogerService;

class SmsService
{
    /**
     * @var SMSlogerService
     */
    protected $logerService;
    protected  $logData;
    /**
     * @var int
     */
    protected $status;
    /**
     * @var string
     */
    protected $errorMessage;
    public function __construct(SMSlogerService $loger)
    {
        $this->logerService = $loger;
    }

    public function Send($receptor, $message)
    {
        $this->logerService->log($this->logData);
    }
    public function TemplateSend($receptor, $template, $token, $token2, $token3, $token10=null, $token20=null):bool
    {
        $this->logerService->log($this->logData);
        return true;
    }

    /**
     * @return int
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    protected function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }

    /**
     * @param string $errorMessage
     */
    protected function setErrorMessage(string $errorMessage): void
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return mixed
     */
    public function getLogData()
    {
        return $this->logData;
    }

    /**
     * @param mixed $logData
     */
    public function setLogData($logData): void
    {
        $this->logData = $logData;
    }




}