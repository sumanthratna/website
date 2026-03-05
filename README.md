# Sumanth Ratna Website

Personal website and blog built with [Astro](https://astro.build/).

## Tech Stack

- Astro 5 with TypeScript (strict config)
- Astro content collections for blog posts
- MD and MDX content support
- Math rendering with `remark-math` + `rehype-katex`
- RSS feed generation with `@astrojs/rss`
- Sitemap generation with `@astrojs/sitemap`

## Prerequisites

- Node.js 20+
- pnpm 10+

## Local Development

```bash
pnpm install
pnpm run dev
```

Astro will start a local dev server (typically at `http://localhost:4321`).

## Available Scripts

- `pnpm run dev` - start the local development server
- `pnpm run build` - create a production build in `dist/`
- `pnpm run preview` - preview the production build locally
- `pnpm run format` - format the codebase with Prettier
- `pnpm astro` - run Astro CLI commands directly

## Project Structure

```text
.
|- src/
|  |- components/      # shared UI components
|  |- layouts/         # page layouts (for blog posts)
|  |- pages/           # route-based pages
|  |- styles/          # global styles and theme tokens
|  |- content.config.ts
|- public/             # static assets
|- astro.config.mjs    # Astro + markdown integration config
```

Blog posts are loaded from `src/content/blog/**/*.{md,mdx}`.

## Writing Blog Posts

Create a new file in `src/content/blog/`, for example:

- `src/content/blog/my-first-post.mdx`
- `src/content/blog/research/notes.md`

Each post must include this frontmatter shape:

```md
---
title: "Post title"
description: "Short description"
pubDate: 2026-03-04
updatedDate: 2026-03-05 # optional
---
```

### Math in Posts

- Inline math: `$E = mc^2$`
- Block math:

```tex
$$
\int_0^1 x^2 dx = \frac{1}{3}
$$
```

## Site Metadata

- Update site title/description in `src/consts.ts`
- Update canonical site URL in `astro.config.mjs` (`site`)

## Production Build

```bash
pnpm build
pnpm preview
```

The production output is generated in `dist/`, including:

- `sitemap-index.xml`
- `rss.xml`
