---
title: Build a PHP portfolio with Arix and an AI agent
excerpt: Build a PHP portfolio with a Markdown blog and test it without Composer or frontend builds in production.
publishedAt: 2026-11-06
---
# Build a PHP portfolio with Arix and an AI agent {#portfolio-with-ai}

Build a developer portfolio with PHP and a Markdown blog, from installing the CLI to running tests. Arix renders HTML on the server and organizes routes, controllers, services, and views; an AI agent will help you plan and implement the project. The result is designed for compatible PHP hosting without Composer, Node, or frontend builds in production.

## What you'll build {#what-youll-build}

- `/`: an introduction, skills, and featured projects.
- `/blog`: a listing of example articles written in Markdown.
- `/blog/{slug}`: an article detail page and a 404 response if it does not exist.
- A responsive, accessible interface with automated tests.

You do not need a database, authentication, an admin panel, or a working contact form. Arix is an option for this project because it renders pages with PHP and keeps the files needed to run them on the server; if you only need pages that do not change, a static site may also be sufficient.

## Before you begin {#prerequisites}

You need a terminal, an internet connection, and a coding agent with a planning mode. The packaged CLI includes PHP for development. Impeccable and Anatomy are optional: if you choose to install them, you need Node and `npx` on your computer. Arix does not require Composer, Node, or frontend builds on the server. Hosting requires PHP 8.4.1 or later, mbstring, and a compatible web server; see the [deployment guide](../guide/deployment).

## Install Arix and create the application {#install-arix}

On macOS or Linux, using Homebrew:

```sh
brew install arixphp/tap/arix
```

On Windows, using WinGet:

```sh
winget install ArixPHP.CLI
```

The packaged CLI includes PHP for development. Create the application and enter its directory:

```sh
arix new portfolio
cd portfolio
```

Run the following commands from that root. See the [installation guide](../guide/installation) for more details.

## Describe the product in the README {#product-readme}

Replace the initial `README.md` contents of the newly created application with the text below so the agent understands the product. This replaces the documentation in that file: save it first if you need it. If you are working in an existing project, preserve your own information too. Replace the placeholders with your details.

```markdown
# Developer portfolio

## Purpose and audience
Present my work to potential clients, collaborators, and employers. Visitors
should quickly understand what I do, explore projects and articles, and find
how to contact me, including on mobile devices.

## Content
- Home: a brief introduction, specialties, and featured projects.
- Projects: context, solution, and technologies; use clearly fictional examples
  until I provide real projects.
- Blog: a list and detail pages for example articles about software development.
- Contact: links I provide, without a working contact form.

## Requirements
- An original, readable, responsive design accessible by keyboard and screen reader.
- Respect reduced-motion preferences; any illustration is optional.
- Use Arix and its conventions, with no database, authentication, or editing panel.
- Store articles as Markdown files created by the developer.
- Do not require Composer, Node, or a frontend build on the server.

## Details to supply
- Name and introduction: [add my details]
- Projects and links: [add real projects]
- Email and social links: [add real links]
```

## Optional: use Impeccable for design {#install-skills}

You can continue without this tool. To use [Impeccable](https://impeccable.style/tutorials/getting-started), you need Node.js 18.19 or later and `npx` on your computer, as well as a compatible agent. After preparing the README, install Impeccable from the project root:

```sh
npx impeccable install
```

Select your agent and the project installation, then reload your coding tool.

### Initialize Impeccable {#initialize-impeccable}

In your agent's chat, run:

```text
/impeccable init
```

Impeccable reads the project, asks about missing information, and saves the agreed context in `PRODUCT.md`. Answer its questions and review that file: correct any assumptions and make outstanding decisions clear. The README provides context; it does not replace `PRODUCT.md`. For another agent, check the corresponding syntax in the [Impeccable documentation](https://impeccable.style/docs/init). If you skip this section, you do not need to create `PRODUCT.md`.

## Prepare controllers, views, and tests {#generate-files}

The application already includes `WelcomeController` and a welcome view: reuse them for the portfolio. Do not generate or overwrite them again. Create the blog controller:

```sh
arix make:controller BlogController
```

Now create views for the listing and detail pages:

```sh
arix make:view blog.index
arix make:view blog.show
```

Finally, create the blog feature test. The application already includes `tests/Feature/WelcomeTest.php`: reuse it and adapt it to the new home page.

```sh
arix make:test BlogTest
```

These files are starting points: they do not yet implement the blog or register routes. Generators do not replace existing files by default; if a name already exists, inspect and reuse it or choose another. The agent will complete the behavior and explicitly register routes in `app/routes.php`.

## Ask the agent for a plan {#agent-prompt}

Enable your agent's **planning mode** and paste the prompt below. It does not require skills. At this stage, ask for a plan, not code changes.

```text
I want to build the portfolio and blog described in README.md.
Read README.md, the project instructions, and existing routes, controllers,
views, services, and tests. If PRODUCT.md exists, read it too and point out
any contradictions. Do not assume APIs that are not documented.
Propose an original, accessible visual direction. If I chose Impeccable and it
is available, use it for design. Use Anatomy only if available and I approve it;
its illustration must respect reduced motion and be understandable without animation.

Before editing files, present a step-by-step plan and wait for my approval.
Include affected files, architecture, design decisions, risks, open questions,
and how to verify the result.

For the subsequent implementation:
- Respect Arix architecture and project instructions. Do not modify core/ or add
  dependencies or build steps needed on the server.
- Reuse WelcomeController and the welcome view for the home page.
- Complete BlogController, the blog.index and blog.show views, and explicit routes
  for /blog and /blog/{slug}. Preserve the other existing routes.
- Create ArticleService to list and find example articles in Markdown files created
  by the developer, without a database or visitor publishing. Inject it through
  BlogController's constructor and register factories for both classes in
  app/services.php, preserving existing registrations.
- Store examples in app/content/blog/ with a title and YYYY-MM-DD date in front
  matter. Use lowercase letters, numbers, and hyphens for slugs. Resolve slugs
  using an allowlist, never directly as file paths; return 404 for unknown slugs.
  Escape metadata for its context and consult the Markdown guide to render HTML
  from the developer's files.
- Adapt `tests/Feature/WelcomeTest.php` to test the home page, and complete
  `BlogTest` with tests for the listing, an existing article, and an unknown slug.
  Use Arix's actual testing APIs and preserve the other existing tests.
- Design for small screens, keyboard, screen readers, and reduced motion. Use only
  real details I provide or clearly identified examples.
- Do not implement filtering, deployment, authentication, or contact forms.
```

Review the plan and request changes if needed. Once satisfied, approve it and switch your agent to implementation mode. Review the changes and replace example content with your own before publishing.

## Define the article service {#article-service}

The plan should separate article reading from the controller using `App\Services\ArticleService` in `app/Services/ArticleService.php`. The service lists and finds articles; `BlogController` receives it through its constructor and returns 404 if an article is missing. Arix does not automatically connect constructor arguments, so both factories must be explicitly registered in `app/services.php`.

This example illustrates the connection the agent will implement; it assumes `ArticleService` has a constructor with no arguments and `BlogController` receives the service:

```php
<?php

declare(strict_types=1);

use App\Controllers\BlogController;
use App\Services\ArticleService;
use Arix\Container\Container;

return static function (Container $container): void {
    $container->bind(ArticleService::class, static fn (): ArticleService => new ArticleService());
    $container->bind(BlogController::class, static fn (Container $container): BlogController =>
        new BlogController($container->get(ArticleService::class))
    );
};
```

The container creates the service when it resolves the controller factory. If registrations already exist, preserve them and add the new ones to the existing function. See the [services guide](../guide/services).

The example Markdown files are created by the developer, not visitors. The [Markdown guide](../guide/markdown) explains how to read and render them: safe mode is not a general-purpose HTML sanitizer. Keep an allowlist of documents and escape titles and metadata for their context; do not construct paths directly from the request slug.

## Run the application and tests {#run-and-test}

Start the server from the project root:

```sh
arix dev
```

Open the address shown in the terminal, usually `http://127.0.0.1:8181`. Check the home page, blog, an article, and an unknown URL; also try keyboard navigation and a narrow screen. Stop the server with Ctrl+C. In another terminal, from the root, run:

```sh
arix tests
arix format --test
```

Check these results before considering the project complete:

- `/` and `/blog` return 200; a known article shows its title and content, and an unknown one returns 404.
- Links work with a keyboard and show focus; a narrow screen has no significant horizontal overflow.
- Content is understandable with reduced motion and does not depend on animation.
- `arix tests` and `arix format --test` finish successfully.

The CLI provides the Pest runner and formatter. Arix HTTP tests run in process: they do not verify the web server, rewrites, or protection rules. Check those separately before deploying.

## Keep exploring Arix {#next-steps}

Arix also supports translations through catalogs in `app/lang` and `trans()`; it uses `app.default_locale` by default. It does not automatically add language prefixes or negotiate the request language. See the [localization guide](../guide/localization) if you want to adapt the portfolio for other languages.

As an optional extension, [Anatomy](https://www.skills.sh/wheresryan22/anatomy/anatomy) can help you create an interactive illustration explaining a project. To install it during development, with Node and `npx` and a compatible agent, run `npx skills add https://github.com/wheresryan22/anatomy --skill anatomy` and follow the options for your agent. It is not required for the portfolio.

As optional challenges, add filtering to the blog listing with tests for results and the empty state; or publish the project using the [Hostinger and GitHub deployment guide](deploy-arix-hostinger-github) and the [security guide](../guide/security), checking server protections and keeping secrets out of the repository. You have used Arix routes, views, services, Markdown, and tests to create a PHP application without production build dependencies.
