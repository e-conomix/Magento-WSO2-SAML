<?php

class Hukmedia_Wso2_Helper_Config extends Mage_Core_Helper_Abstract {

    /**
     * Get WSO2 Identity Server config
     *
     * @return array
     */
    public function getWso2SamlConfig() {
        return array_merge(
            $this->getSamlSpConfig(),
            $this->getSamlIdpConfig(),
            $this->getSecurityConfig()
        );
    }

    /**
     * Get WSO2 Identity Server Service Provider settings
     *
     * @return array
     */
    public function getSamlSpConfig() {
        return array(
            'sp' => array(
                'entityId' => Mage::getUrl() . 'wso2/saml2/metadata',
                'assertionConsumerService' => array(
                    'url' => Mage::getUrl() . 'wso2/saml2/acs',
                ),
                'singleLogoutService' => array(
                    'url' => Mage::getUrl() . 'wso2/saml2/sls',
                ),
                'NameIDFormat' => $this->getNameIdFormat(),
                'privateKey' => $this->vgetSamlSpPrivateKey(),
                'x509cert' => $this->getSamlSpCertificate(),
            )
        );
    }

    /**
     * Get WSO2 Identity Server specified NameIDFormat
     *
     * @return string
     */
    public function getNameIdFormat() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/sp/nameidformat', Mage::app()->getStore());
    }

    public function vgetSamlSpPrivateKey() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/sp/privatekey', Mage::app()->getStore());
    }

    public function getSamlSpCertificate() {
        //var_dump(Mage::getStoreConfig('hukmedia_wso2_saml/sp/x509', Mage::app()->getStore())); die();
        return Mage::getStoreConfig('hukmedia_wso2_saml/sp/x509', Mage::app()->getStore());
    }

    /**
     * Get WSO2 Identity Server Identity Provider settings
     *
     * @return array
     */
    public function getSamlIdpConfig() {
        return array(
            'idp' => array(
                'entityId'              => $this->getSamlEntityId(),
                'singleSignOnService'   => array(
                    'url' => $this->getSamlSsoUrl(),
                ),
                'singleLogoutService'   => array(
                    'url' => $this->getSamlSloUrl(),
                ),
                'x509cert' => $this->getSamlX509Cert(),
            )
        );
    }

    /**
     * Get WSO2 Identity Server Entity ID
     *
     * @return string
     */

    public function getSamlEntityId() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/idp/entityid', Mage::app()->getStore());
    }

    /**
     * Get WSO2 Identity Server SSO Url
     *
     * @return string
     */
    public function getSamlSsoUrl() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/idp/sso_url', Mage::app()->getStore());
    }

    /**
     * Get WSO2 Identity Server SLO Url
     *
     * @return string
     */
    public function getSamlSloUrl() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/idp/slo_url', Mage::app()->getStore());
    }

    /**
     * Get WSO2 Identity Server x509 certificate
     *
     * @return string
     */
    public function getSamlX509Cert() {
        return Mage::getStoreConfig('hukmedia_wso2_saml/idp/x509cert', Mage::app()->getStore());
    }

    /**
     * Get WSO2 Security Config
     *
     * @return array
     */
    public function getSecurityConfig () {
        return array(
            'security' => array(
                'signMetadata' => false,
                'nameIdEncrypted' => false,
                'authnRequestsSigned' => true,
                'logoutRequestSigned' => false,
                'logoutResponseSigned' => false,
                'wantMessagesSigned' => false,
                'wantAssertionsSigned' => false,
                'wantAssertionsEncrypted' => false
            )
        );
    }

    /*
    public function signMetadata() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_sign_metadata', Mage::app()->getStore());
    }

    public function nameIdEncrypted() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_nameid_encrypted', Mage::app()->getStore());
    }

    public function authnRequestSigned() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_authnrequest_signed', Mage::app()->getStore());
    }

    public function logoutRequestSigned() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_logoutrequest_signed', Mage::app()->getStore());
    }

    public function logoutResponseSigned() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_logoutresponse_signed', Mage::app()->getStore());
    }

    public function wantAssertionSigned() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_assertion_signed', Mage::app()->getStore());
    }

    public function wantAssertionEncrypted() {
        return (bool) Mage::getStoreConfig('hukmedia_wso2/saml2_group_security/wso2_security_assertion_encrypted', Mage::app()->getStore());
    }*/

}