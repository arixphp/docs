---
title: Deploy Arix to Hostinger with GitHub
excerpt: Connect your repository and publish changes automatically with Hostinger and GitHub.
publishedAt: 2026-11-04
---
# Deploy Arix to Hostinger with GitHub {#deploy-arix-hostinger-github}

Publish an Arix application on Hostinger by connecting your GitHub account and selecting your repository. This guide follows the direct GitHub connection; panel labels and availability can change, so check [Hostinger's Git guide](https://www.hostinger.com/es/support/1583302-como-implementar-un-repositorio-git-en-hostinger/) for other deployment options.

## Before you begin {#before-you-begin}

You need an Arix application on your computer, a GitHub repository containing the files needed to run it, and a Hostinger hosting plan with Git support and a domain configured. The application must include its managed `core/` and public assets. Confirm that the hosting environment supports PHP 8.4.1 or later, the mbstring extension, and a supported web-server integration. Select a compatible PHP version in hPanel.

Run `arix tests` locally before publishing. Arix does not require Composer, Node, or a frontend build on the hosting server. Commit and push the application to the branch you intend to deploy. Never commit `.env`, credentials, or other secrets; use a private repository if the source itself should not be public.

## Prepare production {#prepare-production}

Set `APP_DEBUG=false` in the production environment and configure trusted hosts for the public domain. If you use an `.env` file, create it separately on the server, restrict its permissions, and keep it out of Git. Ensure `storage/cache` is writable for compiled templates; scheduled tasks may also need writable `storage/logs`.

Review the [deployment guide](../guide/deployment) and [security guide](../guide/security). The web server must enforce the application's rewrite and private-file rules, including denial of `.env` variants, `.git`, configuration, and other non-public files. The generated Apache policy requires compatible server settings; do not assume that a successful Git deployment means those protections are active. Run `arix assets:policy apache` locally to review the policy and confirm the hosting configuration supports it.

## Connect the repository {#connect-repository}

In hPanel, open **Hosting**, choose **Manage** for your site, and find the option to connect GitHub. Connect your GitHub account and, when prompted by GitHub, authorize Hostinger to access the repositories you want to deploy. Review the requested permissions and limit access where possible. Select your Arix repository, the branch to deploy, and the installation directory if prompted.

Verify the domain's actual document root and choose the correct destination. Hostinger's manual Git deployment requires an empty destination; check the instructions shown for your chosen connection before proceeding. Back up any existing site and do not delete its files without confirming the consequences. If direct GitHub connection is unavailable, consult [Hostinger's Git guide](https://www.hostinger.com/es/support/1583302-como-implementar-un-repositorio-git-en-hostinger/) for the manual alternative.

Complete the setup in hPanel and deploy the selected repository. Check Hostinger's deployment output for errors. Create the production `.env` only after the initial deployment if the target had to be empty, and verify that future deployments preserve it and other runtime data before relying on automatic updates.

## Enable automatic deployment {#automatic-deployment}

With the direct GitHub connection, you do not need to set up a webhook or SSH key manually as part of the account connection. Confirm the deployment settings shown in hPanel and whether automatic deployment is enabled for your selected branch; the available options can vary.

Push a small, non-sensitive change to the selected branch. Check Hostinger's deployment status and output, then verify the change on the live site. A push to another branch does not update the selected branch. If deployment fails, check the selected branch, the GitHub connection and repository permissions, and Hostinger's deployment output.

## Verify the live site {#verify}

Open the site and a few routes, then check CSS, JavaScript, and other assets. Verify HTTPS and confirm that debug output is disabled. Test that requests for `.env` and its variants, `.git`, configuration, and other private files are denied without exposing their contents. Confirm `storage/cache` is writable and check that your environment file and runtime data remain intact after a subsequent deployment.

If a file should not be deployed or exposed, keep it out of the deployment repository or ensure the server blocks it. Git exclusion alone is not HTTP protection. Consult the [Arix security guide](../guide/security) and verify the server's actual behavior; contact Hostinger if its hosting configuration cannot enforce the required rules.
