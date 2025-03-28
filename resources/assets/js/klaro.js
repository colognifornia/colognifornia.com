const domain = window.location.hostname;

const klaroConfig = {
  version: 1,

  acceptAll: true,

  styling: {
    theme: ['light', 'bottom', 'left']
  },

  translations: {
    zz: {
      privacyPolicyUrl: '/legal/privacy-policy',
    },
    de: {
      ok: 'Akzeptieren',
      decline: 'Ablehnen',
      consentNotice: {
        learnMore: 'Einstellungen & Details'
      },
      purposes: {
        analytics: {
          title: 'Besucher-Statistiken / Reichweitenanalyse'
        },
      }
    },
    en: {
      ok: 'Accept',
      decline: 'Decline',
      consentNotice: {
        learnMore: 'Settings & Details'
      },
    },
  },

  services: [
    {
      name: 'matomo',

      default: false,

      translations: {
          zz: {
            title: 'Matomo'
          },
          en: {
            description: 'Matomo is a privacy-friendly, self-hosted open source web-analytics service.'
          },
          de: {
            description: 'Matomo ist ein datenschutzfreundlicher, selbstgehosteter Open Source Webanalysedienst.'
          },
      },

      purposes: ['analytics'],

      cookies: [
        [/^_pk_.*$/, '/', domain],
        [/^_mtm_.*$/, '/', domain],
        [/^MATOMO.*$/, '/', domain],
      ],

      callback: function(consent, service) {
        if (typeof _paq !== 'undefined') {
          if (consent === true) {
            _paq.push(['rememberCookieConsentGiven']);
            _paq.push(['setConsentGiven']);
          } else {
            _paq.push(['forgetCookieConsentGiven'])
            _paq.push(['deleteCookies']);
          }
        }
      },

      onlyOnce: true,
    },
  ],

};

import * as klaro from 'klaro';

window.klaroConfig = klaroConfig;
window.klaro = klaro;

klaro.setup(klaroConfig);

const manager = klaro.getManager(klaroConfig);

async function logConsent(consents, config) {
    return fetch('https://consent.colognifornia.com/logConsent', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer Gq34hq1kosa6zCvRHWX6'
        },
        credentials: 'include',
        body: JSON.stringify({
            services: {
                ...consents,
            },
            domain,
            config: {
                ...config,
            },
            user_id: document.cookie.match(/consent_user_id_local=([^;]+)/)?.[1],
        }),
    });
}

manager.watch({
  async update(config, eventName, consents) {
    if (eventName !== 'consents') return;

    let res;
    try {
        res = await logConsent(consents, config);
    } catch (error) {
        console.error('Failed to submit log consent request', error);
        return;
    }

    if (!res.ok) {
        let retries = 1;
        do {
            await new Promise(resolve => setTimeout(resolve, 1000 * (retries + 1)));
            console.log(`Retrying to log consent (${retries}/3)`);
            res = await logConsent(consents, config);
            retries++;
        } while (!res.ok && retries <= 3);

        if (!res.ok) {
            console.error('Failed to log consent');
            return;
        }
    }

    res = await res.json();
    document.cookie = `consent_user_id_local=${res.user_id}; domain=.${domain}; path=/; max-age=${60 * 60 * 24 * 365}; SameSite=Strict; Secure`;
    console.log('Consent logged');
  }
})

