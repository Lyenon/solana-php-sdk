<?php

namespace Attestto\SolanaPhpSdk\Util;

use \Attestto\SolanaPhpSdk\Util\Commitment;

/**
 * @property bool $skipPreflight
 * @property Commitment $commitment
 * @property Commitment $preflightCommitment
 * @property int $maxRetries
 * @property int $minContextSlot
 */
class ConfirmOptions
{
    public bool $skipPreflight;
    public Commitment $commitment;
    public Commitment $preflightCommitment;
    public int $maxRetries;
    public int $minContextSlot;

    /**
     * ConfirmOptions constructor.
     * @param false $skipPreflight
     */
    public function __construct(
        $skipPreflight = false
    ) {
        $this->skipPreflight = $skipPreflight;
        $this->commitment = new Commitment('confirmed');
        $this->preflightCommitment = new Commitment('confirmed');
        $this->maxRetries = 0;
        $this->minContextSlot = 0;
    }
}
