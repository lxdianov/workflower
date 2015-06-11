<?php
namespace PHPMentors\Workflower\Workflow\Activity;

use PHPMentors\Workflower\Workflow\Participant\ParticipantInterface;

class WorkItem implements WorkItemInterface, \Serializable
{
    /**
     * @var string
     */
    private $currentState = self::STATE_CREATED;

    /**
     * @var ParticipantInterface
     */
    private $participant;

    /**
     * @var \DateTime
     */
    private $startDate;

    /**
     * @var \DateTime
     */
    private $endDate;

    /**
     * @var ParticipantInterface
     */
    private $endParticipant;

    /**
     * @var string
     */
    private $endResult;

    public function __construct()
    {
    }

    /**
     * {@inheritDoc}
     */
    public function serialize()
    {
        return serialize(array(
            'currentState' => $this->currentState,
            'participant' => $this->participant,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'endParticipant' => $this->endParticipant,
            'endResult' => $this->endResult,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($serialized)
    {
        foreach (unserialize($serialized) as $name => $value) {
            if (property_exists($this, $name)) {
                $this->$name = $value;
            }
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrentState()
    {
        return $this->currentState;
    }

    /**
     * {@inheritDoc}
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndParticipant()
    {
        return $this->endParticipant;
    }

    /**
     * {@inheritDoc}
     */
    public function getEndResult()
    {
        return $this->endResult;
    }

    /**
     * {@inheritDoc}
     */
    public function allocate(ParticipantInterface $participant)
    {
        $this->currentState = self::STATE_ALLOCATED;
        $this->participant = $participant;
    }

    /**
     * {@inheritDoc}
     */
    public function start()
    {
        $this->currentState = self::STATE_STARTED;
        $this->startDate = new \DateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function complete(ParticipantInterface $participant = null)
    {
        $this->currentState = self::STATE_ENDED;
        $this->endDate = new \DateTime();
        $this->endParticipant = $participant === null ? $this->participant : $participant;
        $this->endResult = self::END_RESULT_COMPLETION;
    }
}
