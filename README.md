# Help Me Gator — helpmegator.com

Custom static website for the Help Me Gator web design company. No frameworks, no build step — pure HTML/CSS/JS, which is the whole sales pitch.

## Files

- `index.html` — main landing page (hero, portfolio, straight-talk pitch, services, process, CTA)
- `contact.html` — contact page with quote-request form
- `thanks.html` — post-submission thank-you page
- `styles.css` — all styling
- `script.js` — mobile nav, scroll-reveal animations, footer year
- `assets/` — logos (logo-main.png, mascot.png, wordmark-eye.png)

## Contact form (important — one-time activation)

The form posts to **formsubmit.co**, which forwards submissions to `gator@helpmegator.com` — no backend or account needed. **The first time someone submits the form on the live site, FormSubmit emails gator@helpmegator.com a one-click confirmation link. Click it once and all future submissions flow through.** Submit a test yourself after launch to trigger it. (The gator@helpmegator.com mailbox must exist and be able to receive mail first.)

After confirming, FormSubmit gives you a random alias (like `formsubmit.co/el/abc123`) you can swap into the form `action` to hide the raw email address from spam bots.

The form redirects to `https://helpmegator.com/thanks.html` after submission (`_next` hidden field) — this only works once the site is live on the real domain.

## Deploying

Any static host works. Easy options:

- **Cloudflare Pages / Netlify / Vercel** (free): drag-and-drop this folder or connect a git repo, then point the helpmegator.com DNS at it.
- **Any shared host**: upload the folder contents to the web root.

No build step. Upload and done.

## Local preview

```
npx http-server . -p 8737
```
