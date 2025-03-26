<?php

namespace Attestto\SolanaPhpSdk\Programs\SplToken\Instructions;

use Attestto\SolanaPhpSdk\Exceptions\InputValidationException;
use Attestto\SolanaPhpSdk\Programs\SystemProgram;
use Attestto\SolanaPhpSdk\PublicKey;
use Attestto\SolanaPhpSdk\TransactionInstruction;
use Attestto\SolanaPhpSdk\Util\AccountMeta;
use Attestto\SolanaPhpSdk\Util\Buffer;

trait SPLTokenInstructions
{

    /**
     * @param PublicKey $payer
     * @param PublicKey $associatedToken
     * @param PublicKey $owner
     * @param PublicKey $mint
     * @param null $programId
     * @param null $associatedTokenProgramId
     * @return TransactionInstruction
     * @throws InputValidationException
     */
    public function createAssociatedTokenAccountInstruction(
        PublicKey $payer,
        PublicKey $associatedToken,
        PublicKey $owner,
        PublicKey $mint,
                  $programId = null,
                  $associatedTokenProgramId = null
    ): TransactionInstruction
    {
        if (!$programId) {
            $programId = $this->SOLANA_TOKEN_PROGRAM_ID;
        }
        if (!$associatedTokenProgramId) {
            $associatedTokenProgramId = $this->SOLANA_TOKEN_PROGRAM_ID;
        }

        return $this->buildAssociatedTokenAccountInstruction(
            $payer,
            $associatedToken,
            $owner,
            $mint,
            new Buffer([]),
            $programId,
            $associatedTokenProgramId
        );
    }

    /**
     * @param $payer
     * @param $associatedToken
     * @param $owner
     * @param $mint
     * @param $instructionData
     * @param $programId
     * @param $associatedTokenProgramId
     * @return TransactionInstruction
     */
    public function buildAssociatedTokenAccountInstruction(
        $payer,
        $associatedToken,
        $owner,
        $mint,
        $instructionData,
        $programId,
        $associatedTokenProgramId
    ): TransactionInstruction
    {

        $keys = [
            new AccountMeta($payer, true, true),
            new AccountMeta($associatedToken, false, true),
            new AccountMeta($owner, false, false),
            new AccountMeta($mint, false, false),
            new AccountMeta(SystemProgram::programId(), false, false),
            new AccountMeta($programId, false, false),
        ];


        return new TransactionInstruction(
            $associatedTokenProgramId,
            $keys,
            $instructionData
        );
    }


    /**
     * @throws InputValidationException
     */
    function createSyncNativeInstruction(PublicKey $owner, string $programId = self::TOKEN_PROGRAM_ID): TransactionInstruction
    {
        $keys = [
            new AccountMeta($owner, false, true),
        ];
        $data = str_repeat("\0", TokenInstruction::SyncNative);
        return new TransactionInstruction(
            new PublicKey($programId),
            $keys,
            $data
        );
    }
}
