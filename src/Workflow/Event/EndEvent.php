<?php
/*
 * Copyright (c) Atsuhiro Kubo <kubo@iteman.jp> and contributors,
 * All rights reserved.
 *
 * This file is part of Workflower.
 *
 * This program and the accompanying materials are made available under
 * the terms of the BSD 2-Clause License which accompanies this
 * distribution, and is available at http://opensource.org/licenses/BSD-2-Clause
 */

namespace PHPMentors\Workflower\Workflow\Event;

class EndEvent extends Event
{
    /**
     * @var \DateTime
     *
     * @since Property available since Release 2.0.0
     */
    private $endDate;

    /**
     * @return \DateTime|null
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    /**
     * {@inheritdoc}
     */
    public function end(): void
    {
        $this->endDate = new \DateTime();
        $this->getProcessInstance()->end($this);
    }
}
