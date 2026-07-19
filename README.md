# Help Me Gator — helpmegator.com

Custom static website for the Help Me Gator web design company. No frameworks, no build step — pure HTML/CSS/JS, which is the whole sales pitch.

## Files

- `index.html` — main landing page (hero, portfolio, straight-talk pitch, services, process, CTA)
- `contact.html` — contact page with quote-request form
- `thanks.html` — post-submission thank-you page
- `send-quote.php` — self-hosted contact form handler (emails submissions via PHP `mail()`)
- `styles.css` — all styling
- `script.js` — mobile nav, scroll-reveal animations, footer year
- `assets/` — logos (logo-main.png, mascot.png, wordmark-eye.png)

## Contact form

The form posts to `send-quote.php`, a self-hosted PHP handler (no third-party services). It validates the fields, blocks bots with a honeypot, and emails the request to `gator@helpmegator.com` via PHP `mail()` — which works out of the box on cPanel hosting. On success it redirects to `thanks.html`; on failure back to `contact.html?error=1`, which shows an error banner.

Requirements: PHP on the host (cPanel has it by default) and the `gator@helpmegator.com` mailbox existing so mail can be delivered. The From address is `noreply@helpmegator.com` (same domain, so it passes spam checks); the visitor's address goes in Reply-To, so hitting Reply answers them directly.

Note: the form can't be tested on the local static preview (no PHP) — test it on the live server.

## Deploying

Any static host works. Easy options:

- **Cloudflare Pages / Netlify / Vercel** (free): drag-and-drop this folder or connect a git repo, then point the helpmegator.com DNS at it.
- **Any shared host**: upload the folder contents to the web root.

No build step. Upload and done.

## Local preview

```
npx http-server . -p 8737
```
