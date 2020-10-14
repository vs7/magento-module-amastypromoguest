<?php

class VS7_AmastyPromoGuest_Block_Notice extends Mage_Core_Block_Template
{
    protected $_validRules = array();

    public function getAvailableNonGuestRuleIds()
    {
        $currentQuote = Mage::getModel('checkout/cart')->getQuote();
        $afterQuote = Mage::getModel('sales/quote');
        $afterQuote->merge($currentQuote);
        $afterQuote->setIsFake(true);
        $afterQuote->setCustomerGroupId(1);
        $afterQuote->collectTotals();

        $currentRuleIds = $currentQuote->getAppliedRuleIds();
        $afterRuleIds = $afterQuote->getAppliedRuleIds();

        $afterRulesArray = explode(",", $afterRuleIds);
        $currentRulesArray = explode(",", $currentRuleIds);
        foreach ($afterRulesArray as $ruleId){
            if (!in_array($ruleId,$currentRulesArray)){
                $this->_validRules[] = $ruleId;
            }
        }
        return $this->_validRules;
    }
}