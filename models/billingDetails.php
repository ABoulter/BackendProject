<?php

require_once("base.php");
class BillingDetails extends Base
{
    public function insertDetails($agreement, $token, $userId)
    {

        $query = $this->db->prepare("INSERT INTO billingDetails
                                    (agreementId, nextBillingDate, token, userId)
                                    VALUES(:agreementId, :nextBillingDate, :token, :username)");

        $agreementDetails = $agreement->getAgreementDetails();

        $query->bindValue(":agreementId", $agreement->getId());
        $query->bindValue(":nextBillingDate", $agreementDetails->getNextBillingDate());
        $query->bindValue(":token", $token);
        $query->bindValue(":username", $userId);

        return $query->execute();

    }
}
?>