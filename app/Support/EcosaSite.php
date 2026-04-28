<?php

namespace App\Support;

class EcosaSite
{
    public static function organization(): array
    {
        return [
            'association_name' => 'Equatorial College School Old Students Association',
            'short_name' => 'ECOSA',
            'tagline' => 'United by heritage. Driven by impact.',
            'school_name' => 'Equatorial College School',
            'website' => 'https://ecs.ac.ug',
            'website_label' => 'ecs.ac.ug',
            'location' => 'Kyarutanga Cell, Kyeikucu Ward, Kagongo Division, Ibanda Municipality, Uganda',
            'location_short' => 'Ibanda, Western Uganda',
            'postal_address' => 'P.O. Box 53, Ibanda, Uganda',
            'office_hours' => [
                'Monday - Friday: 8:00 AM - 5:00 PM',
                'Saturday: 9:00 AM - 1:00 PM',
                'Sunday: Closed',
            ],
            'phones' => [
                '+256393101928',
                '+256772692320',
                '+256773181857',
            ],
            'emails' => [
                'info@ecs.ac.ug',
                'equatorialcollegeibanda@gmail.com',
            ],
            'map_embed_url' => 'https://www.google.com/maps?q=Equatorial%20College%20School%20Ibanda%20Uganda&output=embed',
            'map_directions_url' => 'https://www.google.com/maps/search/?api=1&query=Equatorial+College+School+Ibanda+Uganda',
        ];
    }

    public static function heroSlides(): array
    {
        return [
            [
                'eyebrow' => 'Equatorial College School Old Students Association',
                'title' => 'Equatorial College School Old Students Association',
                'text' => 'Connecting alumni globally, building lasting impact, and supporting our alma mater through a vibrant network of professionals.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
                'primary_cta_label' => 'Register Now',
                'primary_cta_route' => 'site.membership.register',
                'secondary_cta_label' => 'About ECOSA',
                'secondary_cta_route' => 'site.about',
            ],
            [
                'eyebrow' => 'Legacy & Community',
                'title' => 'Building a Legacy of Excellence',
                'text' => 'Join our 500+ members in fostering growth, mentorship, and community among the alumni of Equatorial College School.',
                'image' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
                'primary_cta_label' => 'Explore Community',
                'primary_cta_route' => 'site.community',
                'secondary_cta_label' => 'Register Today',
                'secondary_cta_route' => 'site.membership.register',
            ],
            [
                'eyebrow' => 'Membership, Visibility, and Impact',
                'title' => 'A Stronger Platform for Senior Alumni',
                'text' => 'A more corporate website experience for members, leaders, partners, and school-centered community programs.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
                'primary_cta_label' => 'View Updates',
                'primary_cta_route' => 'site.updates',
                'secondary_cta_label' => 'Leadership Page',
                'secondary_cta_route' => 'site.leadership',
            ],
        ];
    }

    public static function membershipBenefits(): array
    {
        return [
            'Know and reconnect with close friends, classmates, chapter members, professionals, and business owners in the ECOSA network.',
            'Access leadership guidance through the patron, elders group, executive leaders, and chapter contacts when support is needed.',
            'Advertise or discover alumni businesses through searchable professional and business information.',
            'Support ECOSA voluntarily through membership payments, donations, chapter support, project support, and welfare contributions.',
            'Take part in chapters, health insurance conversations, proposals, projects, resources, and member-focused reports.',
        ];
    }

    public static function guidingPrinciples(): array
    {
        return [
            [
                'title' => 'Respect and accountability',
                'text' => 'Members engage with dignity, protect the ECOSA name, and remain accountable to agreed association decisions.',
            ],
            [
                'title' => 'Voluntary contribution',
                'text' => 'Support is encouraged on a willing note, with clear payment purpose and verification by the responsible team.',
            ],
            [
                'title' => 'One member, one chapter',
                'text' => 'A member belongs to one primary chapter at a time to keep coordination, reporting, and chapter support clear.',
            ],
            [
                'title' => 'Service before status',
                'text' => 'Leadership, elders, patrons, and chapter heads exist to guide members and strengthen the wider alumni family.',
            ],
        ];
    }

    public static function leadershipContactLevels(): array
    {
        return [
            [
                'level' => 'Patron',
                'purpose' => 'High-level guidance, association protection, and institutional counsel.',
            ],
            [
                'level' => 'Elders Group',
                'purpose' => 'Experience-based advice, conflict guidance, mentorship, and member support.',
            ],
            [
                'level' => 'Executive Committee',
                'purpose' => 'Daily coordination, records, communication, finance, projects, and member decisions.',
            ],
            [
                'level' => 'Chapter Leaders',
                'purpose' => 'Local member mobilization, chapter confirmation, close-friend networks, and regional support.',
            ],
        ];
    }

    public static function leadershipGroups(): array
    {
        return [
            [
                'title' => 'Top Leadership',
                'text' => 'Chairperson, vice chairperson, treasurer, secretary, and executive officers responsible for association decisions.',
                'roles' => ['Chairperson', 'Vice Chairperson', 'Treasurer', 'General Secretary'],
            ],
            [
                'title' => 'Patron and Pioneers',
                'text' => 'Senior guides, founders, pioneers, and elders who provide long-term counsel and institutional memory.',
                'roles' => ['Patron', 'Pioneers', 'Elders Group', 'Advisory Team'],
            ],
            [
                'title' => 'Chapter Leaders',
                'text' => 'Approved chapter heads who coordinate professional, business, regional, diaspora, and class-year groups.',
                'roles' => ['Regional Leads', 'Professional Leads', 'Business Leads', 'Diaspora Leads'],
            ],
            [
                'title' => 'Class Representatives',
                'text' => 'Representatives by completion year who help classmates reconnect, organize, and seek the right support.',
                'roles' => ['Year Representatives', 'Class Coordinators', 'Peer Mobilizers'],
            ],
        ];
    }

    public static function chapters(): array
    {
        return [
            [
                'name' => 'Kampala Chapter',
                'region' => 'Central Uganda',
                'focus' => 'Professional networking, business discovery, and city-based ECOSA coordination.',
            ],
            [
                'name' => 'Ibanda Chapter',
                'region' => 'Western Uganda',
                'focus' => 'School-facing support, local alumni coordination, and community project follow-up.',
            ],
            [
                'name' => 'Diaspora Chapter',
                'region' => 'Outside Uganda',
                'focus' => 'Remote participation, fundraising support, professional links, and international member updates.',
            ],
        ];
    }

    public static function resources(): array
    {
        return [
            'ECOSA constitution and governance documents',
            'Project proposals and shortlists',
            'External documents and partner resources',
            'Ugandan anthem and school heritage materials',
            'Membership details, chapter guidelines, and reporting templates',
        ];
    }

    public static function homeShowcaseCards(): array
    {
        return [
            [
                'title' => 'Leadership & Governance',
                'summary' => 'Executive visibility, governance clarity, and stronger trust for senior stakeholders.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
                'route' => 'site.leadership',
            ],
            [
                'title' => 'Membership Registration',
                'summary' => 'A cleaner flow for alumni records, payment, and digital membership identity.',
                'image' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
                'route' => 'site.membership.register',
            ],
            [
                'title' => 'Alumni Business Network',
                'summary' => 'A more visible platform for professionals, entrepreneurs, and partner opportunities.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
                'route' => 'site.membership',
            ],
            [
                'title' => 'School Support Projects',
                'summary' => 'Visible project pages for mentorship, campus support, and strategic giving.',
                'image' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
                'route' => 'site.community.projects',
            ],
            [
                'title' => 'Events & Reunions',
                'summary' => 'Route-based event pages for flagship gatherings, forums, and annual engagement.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
                'route' => 'site.community.events',
            ],
            [
                'title' => 'Welfare & Insurance',
                'summary' => 'A dedicated page for reassurance, welfare coordination, and practical support.',
                'image' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
                'route' => 'site.community.insurance',
            ],
        ];
    }

    public static function membershipTracks(): array
    {
        return [
            [
                'title' => 'Alumni Registration',
                'summary' => 'For individual old students ready to create a verified ECOSA profile and submit payment.',
                'route' => 'site.membership.register',
                'icon' => 'fa-id-card',
            ],
            [
                'title' => 'Diaspora & International Members',
                'summary' => 'For alumni outside Uganda who need a clear digital route into the association and updates.',
                'route' => 'site.membership',
                'icon' => 'fa-earth-africa',
            ],
            [
                'title' => 'Class Leaders & Partners',
                'summary' => 'For coordinators, class committees, and strategic supporters who need direct engagement.',
                'route' => 'site.contact',
                'icon' => 'fa-handshake',
            ],
        ];
    }

    public static function governancePillars(): array
    {
        return [
            [
                'icon' => 'fa-scale-balanced',
                'title' => 'Constitution-led governance',
                'text' => 'Leadership decisions are anchored in policy, formal accountability, and clear member mandates.',
            ],
            [
                'icon' => 'fa-chart-line',
                'title' => 'Transparent stewardship',
                'text' => 'Funds, member records, and project reporting follow a disciplined administrative structure.',
            ],
            [
                'icon' => 'fa-people-group',
                'title' => 'Intergenerational service',
                'text' => 'Senior alumni, young professionals, and current students are connected through practical support systems.',
            ],
        ];
    }

    public static function leadershipFallback(): array
    {
        return [
            [
                'name' => 'Executive Office',
                'initials' => 'CP',
                'title' => 'Chairperson',
                'portfolio' => 'Strategic Leadership',
                'focus' => 'Provides association-wide direction, executive coordination, and external representation.',
                'icon' => 'fa-crown',
                'tone' => 'blue',
            ],
            [
                'name' => 'General Secretariat',
                'initials' => 'GS',
                'title' => 'General Secretary',
                'portfolio' => 'Administration & Records',
                'focus' => 'Maintains institutional records, communication workflows, and meeting accountability.',
                'icon' => 'fa-file-lines',
                'tone' => 'green',
            ],
            [
                'name' => 'Finance Office',
                'initials' => 'TR',
                'title' => 'Treasurer',
                'portfolio' => 'Finance & Compliance',
                'focus' => 'Oversees member dues, payment verification, and transparent resource stewardship.',
                'icon' => 'fa-wallet',
                'tone' => 'gold',
            ],
            [
                'name' => 'Programs Desk',
                'initials' => 'PS',
                'title' => 'Publicity Secretary',
                'portfolio' => 'Communications & Outreach',
                'focus' => 'Keeps ECOSA visible through coordinated updates, event communication, and member engagement.',
                'icon' => 'fa-bullhorn',
                'tone' => 'rose',
            ],
        ];
    }

    public static function updatesFallback(): array
    {
        return [
            [
                'category' => 'Association',
                'title' => 'ECOSA constitution review cycle launched',
                'summary' => 'Leadership has opened a structured consultation process to align association governance with current alumni needs.',
                'body' => 'The review focuses on governance clarity, digital member records, and stronger delivery across alumni programs.',
                'image' => asset('assets/images/school/aerialview.jpeg'),
            ],
            [
                'category' => 'Projects',
                'title' => 'School-support fundraising pipeline activated',
                'summary' => 'Corporate alumni and class representatives are coordinating the next phase of school-impact fundraising.',
                'body' => 'Priority areas include academic support, infrastructure improvements, and stronger member-led giving channels.',
                'image' => asset('assets/images/school/Equatorial-College-School5.jpeg'),
            ],
        ];
    }

    public static function communityFallback(string $type): array
    {
        return match ($type) {
            'project' => [
                [
                    'title' => 'Health insurance and welfare proposal',
                    'summary' => 'A structured project area for member welfare, insurance conversations, emergency support, and proposal review.',
                    'location' => 'Association-wide',
                    'status' => 'active',
                ],
                [
                    'title' => 'Chapter creation and coordination',
                    'summary' => 'A project stream for creating chapters, listing available chapters, confirming members, and keeping one primary chapter per member.',
                    'location' => 'Regional chapters and diaspora',
                    'status' => 'active',
                ],
                [
                    'title' => 'Campus improvement partnership',
                    'summary' => 'A structured alumni contribution drive focused on visible campus upgrades, school support, and shared ownership.',
                    'location' => 'Equatorial College School',
                    'status' => 'active',
                ],
                [
                    'title' => 'Mentorship and careers network',
                    'summary' => 'A member-led platform matching senior alumni with students and young graduates for practical career guidance.',
                    'location' => 'Regional chapters and online',
                    'status' => 'active',
                ],
            ],
            'insurance_group' => [
                [
                    'title' => 'Member welfare and insurance coordination',
                    'summary' => 'A collective welfare structure designed to support members through emergencies, transitions, and solidarity needs.',
                    'location' => 'Association-wide',
                    'status' => 'active',
                ],
                [
                    'title' => 'Household protection information sessions',
                    'summary' => 'Periodic engagements that help members understand available insurance options and group participation models.',
                    'location' => 'Hybrid briefings',
                    'status' => 'active',
                ],
            ],
            default => [
                [
                    'title' => 'Annual alumni homecoming',
                    'summary' => 'A flagship reunion designed for reconnection, class representation, and corporate-style association updates.',
                    'location' => 'Equatorial College School main campus',
                    'status' => 'upcoming',
                ],
                [
                    'title' => 'Professional impact forum',
                    'summary' => 'A networking event bringing together alumni leaders, professionals, and business owners around shared growth.',
                    'location' => 'Kampala and regional hubs',
                    'status' => 'upcoming',
                ],
            ],
        };
    }

    public static function occupationTypes(): array
    {
        return [
            'professional' => 'Professional Practice',
            'employment' => 'Employment / Job',
            'business' => 'Business / Enterprise',
        ];
    }

    public static function maritalStatuses(): array
    {
        return [
            'single' => 'Single',
            'married' => 'Married',
            'divorced' => 'Divorced',
            'widowed' => 'Widowed',
        ];
    }

    public static function paymentOptions(): array
    {
        return [
            'mtn_mobile_money' => 'MTN MoMo',
            'airtel_money' => 'Airtel Money',
        ];
    }

    public static function paymentPurposeOptions(): array
    {
        return [
            'membership' => 'Membership',
            'donation' => 'Donation',
            'chapter_support' => 'Chapter Support',
            'project_support' => 'Project Support',
            'welfare_support' => 'Welfare / Insurance Support',
        ];
    }

    public static function whatsappContacts(): array
    {
        return [
            [
                'name' => 'Membership Desk',
                'role' => 'Registration & Payments',
                'phone' => '+256393101928',
                'number_display' => '+256 393 101 928',
                'initials' => 'MD',
                'color' => '#17924b',
            ],
            [
                'name' => 'General Inquiries',
                'role' => 'Information & Support',
                'phone' => '+256772692320',
                'number_display' => '+256 772 692 320',
                'initials' => 'GI',
                'color' => '#173a60',
            ],
        ];
    }

    public static function inquiryTypes(): array
    {
        return [
            'Membership Support',
            'Projects & Partnerships',
            'Insurance Group',
            'General Inquiry',
        ];
    }

    public static function sponsors(): array
    {
        return [
            ['name' => 'Equatorial College School', 'logo' => asset('assets/images/school/aerialview.jpeg'), 'url' => 'https://ecs.ac.ug'],
            ['name' => 'Uganda Alumni Network', 'logo' => asset('assets/images/school/Equatorial-College-School5.jpeg'), 'url' => ''],
            ['name' => 'Ibanda Municipality', 'logo' => asset('assets/images/school/aerialview.jpeg'), 'url' => ''],
            ['name' => 'Alumni Partners', 'logo' => asset('assets/images/school/Equatorial-College-School5.jpeg'), 'url' => ''],
        ];
    }
}
