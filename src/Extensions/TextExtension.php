<?php

namespace Xefi\Faker\EnNz\Extensions;

use Xefi\Faker\Extensions\TextExtension as BaseTextExtension;

class TextExtension extends BaseTextExtension
{
    /**
     * The extension locale.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'en_NZ';
    }

    protected array $paragraphs = [
        [
            ['Every', 'organisation', 'needs', 'a', 'clear', 'plan', 'before', 'the', 'financial', 'year', 'ends', 'in', 'March.'],
            ['Teams', 'from', 'both', 'islands', 'share', 'their', 'results', 'and', 'what', 'they', 'have', 'learnt.'],
            ['Good', 'communication', 'keeps', 'regional', 'offices', 'connected', 'with', 'head', 'office.'],
            ['Whanau', 'and', 'community', 'remain', 'at', 'the', 'heart', 'of', 'the', 'culture.'],
        ],
        [
            ['The', 'service', 'centre', 'answers', 'enquiries', 'from', 'customers', 'right', 'around', 'the', 'country.'],
            ['Staff', 'favour', 'practical', 'solutions', 'over', 'lengthy', 'reports.'],
            ['Feedback', 'is', 'gathered', 'regularly', 'so', 'that', 'the', 'programme', 'keeps', 'improving.'],
            ['Small', 'changes', 'to', 'daily', 'routines', 'often', 'deliver', 'the', 'biggest', 'gains.'],
        ],
        [
            ['Labour', 'costs', 'and', 'travel', 'expenses', 'are', 'reviewed', 'at', 'the', 'end', 'of', 'each', 'quarter.'],
            ['Managers', 'prioritise', 'safety', 'on', 'every', 'site,', 'from', 'the', 'city', 'to', 'the', 'back', 'country.'],
            ['Suppliers', 'are', 'chosen', 'for', 'their', 'reliability', 'as', 'much', 'as', 'their', 'price.'],
            ['The', 'catalogue', 'is', 'updated', 'whenever', 'a', 'new', 'licence', 'is', 'granted.'],
        ],
        [
            ['Training', 'helps', 'employees', 'build', 'skills', 'that', 'last', 'well', 'beyond', 'a', 'single', 'project.'],
            ['Mentors', 'encourage', 'graduates', 'to', 'ask', 'questions', 'and', 'take', 'initiative.'],
            ['Flexible', 'arrangements', 'allow', 'people', 'to', 'balance', 'work', 'with', 'family', 'and', 'rugby.'],
            ['Positive', 'behaviour', 'is', 'recognised', 'and', 'celebrated', 'at', 'the', 'monthly', 'shared', 'lunch.'],
        ],
        [
            ['Reliable', 'data', 'supports', 'better', 'decisions', 'and', 'clearer', 'priorities.'],
            ['Targets', 'are', 'adjusted', 'when', 'market', 'conditions', 'change', 'unexpectedly.'],
            ['Regular', 'reviews', 'make', 'it', 'easier', 'to', 'respond', 'to', 'new', 'challenges.'],
            ['Customers', 'value', 'honest', 'advice', 'and', 'a', 'friendly', 'chat.'],
            ['Long-term', 'growth', 'depends', 'on', 'steady', 'and', 'sustainable', 'progress.'],
        ],
    ];
}
