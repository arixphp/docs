<?php

declare(strict_types=1);

namespace App\Documentation;

class Guide
{
    public static function pages(): array
    {
        return [
            '/guide/' => ['Introduction', 'Getting Started', 'introduction'],
            '/guide/installation' => ['Installation', 'Getting Started', 'installation'],
            '/guide/first-application' => ['Your First Application', 'Getting Started', 'first-application'],
            '/guide/deployment' => ['Deployment', 'Getting Started', 'deployment'],
            '/guide/structure' => ['Application Structure', 'The Basics', 'structure'],
            '/guide/configuration' => ['Configuration', 'The Basics', 'configuration'],
            '/guide/routing' => ['Routing', 'The Basics', 'routing'],
            '/guide/controllers' => ['Controllers', 'The Basics', 'controllers'],
            '/guide/http' => ['Requests and Responses', 'The Basics', 'http'],
            '/guide/views' => ['Views', 'The Basics', 'views'],
            '/guide/middleware' => ['Middleware', 'Digging Deeper', 'middleware'],
            '/guide/services' => ['Services', 'Digging Deeper', 'services'],
            '/guide/localization' => ['Localization', 'Digging Deeper', 'localization'],
            '/guide/assets' => ['Assets', 'Digging Deeper', 'assets'],
            '/guide/storage' => ['File Storage', 'Digging Deeper', 'storage'],
            '/guide/markdown' => ['Markdown', 'Digging Deeper', 'markdown'],
            '/guide/caching' => ['Caching', 'Digging Deeper', 'caching'],
            '/guide/scheduling' => ['Scheduling', 'Digging Deeper', 'scheduling'],
            '/guide/http-client' => ['HTTP Client', 'Digging Deeper', 'http-client'],
            '/guide/testing' => ['Testing', 'Testing', 'testing'],
            '/guide/cli' => ['Arix CLI', 'Arix CLI', 'cli'],
            '/guide/cli-development' => ['Development Server', 'Arix CLI', 'cli-development'],
            '/guide/cli-generators' => ['Code Generation', 'Arix CLI', 'cli-generators'],
            '/guide/cli-updates' => ['Managed Updates', 'Arix CLI', 'cli-updates'],
            '/guide/helpers' => ['Helpers', 'Reference', 'helpers'],
            '/guide/security' => ['Security', 'Reference', 'security'],
            '/guide/troubleshooting' => ['Troubleshooting', 'Reference', 'troubleshooting'],
        ];
    }
}
