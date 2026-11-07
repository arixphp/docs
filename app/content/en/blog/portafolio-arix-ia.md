---
title: Build a portfolio with Arix and an AI agent
excerpt: Build a portfolio and blog from scratch with Arix, Impeccable, and AI-guided development.
publishedAt: 2026-11-06
---
# Build a portfolio with Arix and an AI agent {#portfolio-with-ai}

Build a developer portfolio with a blog, from installing the CLI to running tests. Prepare the context and starter files, then ask an AI agent to propose a plan before implementing it. Use Impeccable to guide the design and, optionally, Anatomy for an interactive illustration explaining one of your projects.

## Before you begin {#prerequisites}

You need a terminal, an internet connection, a coding agent that supports skills, and Node.js 18.19 or later with `npx` on your computer. Node is used here to install AI tools; it is not a production requirement for the application. Arix does not require Composer, Node, or frontend builds on the server. Hosting requires PHP 8.4.1 or later, mbstring, and a compatible web server; see the [deployment guide](../guide/deployment).

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

## Install the skills {#install-skills}

Install Impeccable and select your agent and project installation when prompted:

```sh
npx impeccable install
```

Install Anatomy to make the optional illustration available:

```sh
npx skills add https://github.com/wheresryan22/anatomy --skill anatomy
```

Follow the installer's options for your agent and reload your coding tool. Command names and compatibility depend on the agent: consult the current [Impeccable](https://impeccable.style/tutorials/getting-started) and [Anatomy](https://www.skills.sh/wheresryan22/anatomy/anatomy) instructions if the skills do not appear. Install only tools you trust.

## Describe the product in the README {#product-readme}

Before initializing Impeccable, replace the `README.md` contents of the newly created application with the text below. If you are working in an existing project, first preserve any information you need. Replace the placeholders with your details.

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

## Initialize Impeccable {#initialize-impeccable}

In your agent's chat, run:

```text
/impeccable init
```

Impeccable reads the project, asks about missing information, and saves the agreed context in `PRODUCT.md`. Answer its questions and review that file: correct any assumptions and make outstanding decisions clear. The README provides context; it does not replace `PRODUCT.md`. For another agent, check the corresponding syntax in the [Impeccable documentation](https://impeccable.style/docs/init).

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

## Define the article service {#article-service}

To separate article reading from the controller, ask the agent to create `App\Services\ArticleService` in `app/Services/ArticleService.php`. Its responsibility will be to list the Markdown articles you create and find one by its slug. The controller will receive the service through its constructor and use it to prepare the views; if it cannot find an article, it will respond with 404.

Arix does not automatically connect constructor arguments. To inject the service, register a factory for each class in `app/services.php`. This example shows the connection the agent will implement; it assumes `ArticleService` has a constructor with no arguments and `BlogController` receives the service:

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

The container creates the service when it resolves the controller factory and passes it to the constructor. If `app/services.php` already contains registrations, preserve them and add these to the existing function. The next prompt asks the agent to create the classes and complete this connection after you approve the plan. See the [services guide](../guide/services) for more registration options.

## Ask the agent for a plan {#agent-prompt}

Enable your agent's **planning mode** and paste the prompt below. Adjust the placeholders and say so if you do not want the illustration. At this stage, ask for a plan, not code changes.

```text
I want to build the portfolio and blog described in README.md.
Read README.md, PRODUCT.md, the project instructions, and the existing code.
Use Impeccable to propose an original, accessible visual direction. If it adds
value and I approve it, use Anatomy for an optional interactive illustration
explaining one project; it must respect reduced-motion preferences and remain
understandable without animation.

Before editing files, present a step-by-step plan and wait for my approval.
Include affected files, design decisions, risks, and how to verify the result.

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
- Resolve slugs using an allowlist, never directly as file paths; return 404 for
  unknown slugs. Escape displayed data and consult the Markdown guide for rendering.
- Adapt `tests/Feature/WelcomeTest.php` to test the home page, and complete
  `BlogTest` with tests for the listing, an existing article, and an unknown slug.
  Use Arix's actual testing APIs and preserve the other existing tests.
- Design for small screens, keyboard, screen readers, and reduced motion. Use only
  real details I provide or clearly identified examples.
- Do not implement filtering, deployment, authentication, or contact forms.
```

Review the plan and request changes if needed. Once satisfied, approve it and switch your agent to implementation mode. Review the changes and replace example content with your own before publishing.

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

The CLI provides the Pest runner and formatter. Arix HTTP tests run in process: they do not verify the web server, rewrites, or protection rules. Check those separately before deploying.

## Keep exploring Arix {#next-steps}

Arix also supports translations through catalogs in `app/lang` and `trans()`; it uses `app.default_locale` by default. It does not automatically add language prefixes or negotiate the request language. See the [localization guide](../guide/localization) if you want to adapt the portfolio for other languages.

As optional challenges, add filtering to the blog listing with tests for results and the empty state; or publish the project using the [Hostinger and GitHub deployment guide](deploy-arix-hostinger-github), checking server protections and keeping secrets out of the repository.
