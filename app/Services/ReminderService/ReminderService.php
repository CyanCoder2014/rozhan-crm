<?php


namespace App\Services\ReminderService;



use App\Services\ReminderService\ReminderRepository\ReminderRepository;

class ReminderService
{
    /**
     * @var ReminderRepository
     */
    protected $repository;
    public function __construct(ReminderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function Send(ReminderObjectValue $reminder)
    {

        $this->repository->add([
            'parent_id'=>$reminder->getParentId(),
            'title'=>$reminder->getTitle(),
            'description'=>$reminder->getDesctiprion(),
            'reference_type'=>$reminder->getModelName(),
            'reference_id'=>$reminder->getModelId(),
            'state'=>$reminder->getState(),
            'status'=>$reminder->getStatus(),
            'execute_at'=>$reminder->getExecuteAt()->format('Y-m-d H:i:s'),
            'reminder_at'=>$reminder->getReminderAt()->format('Y-m-d H:i:s'),
            'notify_type'=>$reminder->getNotifyTypeCode(),
            'created_by'=>auth()->id,
        ]);
    }

    public function Edit(ReminderObjectValue $reminder)
    {

        $this->repository->edit([
            'id'=>$reminder->getId(),
            'parent_id'=>$reminder->getParentId(),
            'title'=>$reminder->getTitle(),
            'description'=>$reminder->getDesctiprion(),
            'reference_type'=>$reminder->getModelName(),
            'reference_id'=>$reminder->getModelId(),
            'state'=>$reminder->getState(),
            'status'=>$reminder->getStatus(),
            'execute_at'=>$reminder->getExecuteAt()->format('Y-m-d H:i:s'),
            'reminder_at'=>$reminder->getReminderAt()->format('Y-m-d H:i:s'),
            'notify_type'=>$reminder->getNotifyTypeCode(),
            'created_by'=>auth()->id,
        ]);
    }
    public function show(ReminderObjectValue $reminder)
    {

        return $this->repository->find( $reminder->getId());
    }

    public function destroy(ReminderObjectValue $reminder)
    {

        return $this->repository->destroy( $reminder->getId());
    }

}