# Design System: Man Page

The site reads like a Unix manual page: `PLACEHOLD(1)`. Plain text, one
monospace face, section headings in bold caps, links as paths. Nothing glows.

## Tokens

Colors live as CSS variables (space-separated RGB) in `resources/css/app.css`
and are mapped to the existing Tailwind token names in `tailwind.config.js`,
so `bg-surface/70`-style opacity modifiers work. Keep the token names; change
values only.

| Token | Paper (default) | Ink (`html.dark`) | Use |
|---|---|---|---|
| `surface` / `background` | `#f6f6f3` | `#1a1a1a` | page |
| `surface-container-*` | `#ecece7`–`#d6d6cf` | `#121212`–`#383835` | boxes, inputs |
| `on-surface` | `#1a1a1a` | `#f6f6f3` | text |
| `on-surface-variant` | `#3d3d3a` | `#c9c9c4` | secondary text |
| `outline` | `#5e5e59` | `#a0a099` | labels, captions |
| `outline-variant` | `#c4c4bc` | `#42423e` | rules |
| `primary` | `#0047b3` | `#ffb000` | links |
| `secondary` | `#8a3b00` | `#80b2ff` | second accent |
| `tertiary` | ink | paper | bold labels |
| `primary-container` | ink | paper | solid buttons (`.liquid-chrome`) |

`.code-block` always uses the ink set (like the SYNOPSIS box), on its own
`--code-bg`. All text pairs above pass WCAG AA in both themes; check new
pairs before adding them.

## Type

JetBrains Mono everywhere (`font-headline`, `font-body`, `font-mono` all map
to it). Letter-spacing is toned down in the config: monospace with wide
tracking reads as noise.

## Rules

- Section headings: bold caps, no tracking (`.section-title`, or `NAME`,
  `SYNOPSIS`, `OPTIONS`, `EXAMPLES`, `SEE ALSO` on man-style pages).
- Page eyebrow: `NAME(1)`, e.g. `IMAGE(1)`.
- Rules are dashed; corners are square (`rounded-*` is 0, except `full`).
- No gradients, glows, blur, pulsing dots or icon fonts. Bullets are `•`.
- Links are underlined on hover; icon-only controls use bracketed text
  (`[menu]`, `[close]`, `[dark]`).
- Footer: SEE ALSO links as `name(section)`, AUTHOR "Built by Shafer LLC".
