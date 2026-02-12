<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        PageSection::updateOrCreate(['section' => 'hero'], [
            'content' => [
                'badge' => 'Global hiring',
                'title' => 'Global Staffing Expansion Made Easy',
                'subtitle' => 'Power your business with top-tier talent across borders. We build compliant, fast, and flexible teams that scale with your goals.',
                'features' => [
                    [
                        'title' => 'Seamless Staffing, Maximum Results',
                        'description' => 'Accelerate hiring with a curated pipeline of specialists, screened and ready to contribute from day one.',
                    ],
                    [
                        'title' => 'Power Your Business',
                        'description' => 'Dedicated account managers coordinate onboarding, payroll, and performance so you can focus on growth.',
                    ],
                ],
                'stats' => [
                    ['label' => 'Remote workforce', 'value' => 'Worldwide teams'],
                    ['label' => 'Local contract', 'value' => 'Compliance ready'],
                    ['label' => 'Book a call', 'value' => 'Talk to experts'],
                ],
            ],
        ]);

        PageSection::updateOrCreate(['section' => 'overview'], [
            'content' => [
                'cards' => [
                    ['title' => 'Scale your business', 'description' => 'Build teams across regions with tailored hiring plans and dedicated specialists.'],
                    ['title' => 'Professional partner', 'description' => 'Partner with specialists committed to your compliance, payroll, and growth.'],
                    ['title' => 'Seamless services', 'description' => 'Integrated hiring, HR, and payroll services that keep your teams aligned.'],
                    ['title' => 'Tailored solutions', 'description' => 'Customized staffing models designed to meet your unique hiring needs.'],
                ],
                'button_text' => 'Learn more',
            ],
        ]);

        PageSection::updateOrCreate(['section' => 'solutions'], [
            'content' => [
                'badge' => 'StaffLink Solutions',
                'title' => 'Save time & cut costs with StaffLink solutions',
                'subtitle' => 'Talent sourcing, global hiring, and compliance support designed to help your teams grow faster and smarter.',
                'cards' => [
                    ['title' => 'Industry qualified', 'description' => 'Access vetted professionals with proven domain expertise.'],
                    ['title' => 'Local expertise', 'description' => 'Navigate regulations with localized HR and payroll support.'],
                    ['title' => 'All-in-one', 'description' => 'One partner for recruitment, onboarding, and retention.'],
                    ['title' => 'Seamless communications', 'description' => 'Centralized reporting and collaboration channels for managers.'],
                    ['title' => 'Customized data protection', 'description' => 'Privacy-by-design processes tailored to your policies.'],
                    ['title' => 'Insightful workforce', 'description' => 'Performance analytics and insights to keep teams thriving.'],
                ],
            ],
        ]);

        PageSection::updateOrCreate(['section' => 'staffing'], [
            'content' => [
                'badge' => 'Talent solutions',
                'title' => 'We find the perfect-match professionals for you',
                'subtitle' => 'From specialists to leadership teams, our global network connects you with the right people for every project.',
                'cards' => [
                    [
                        'title' => 'Domestic service',
                        'description' => 'Local recruiting teams that understand your market and culture.',
                        'image' => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Regional Operations Lead', 'description' => 'Oversee multi-site staffing performance and compliance.', 'link' => '/jobs/regional-operations-lead'],
                            ['title' => 'Client Success Partner', 'description' => 'Manage client relationships and deliver hiring outcomes.', 'link' => '/jobs/client-success-partner'],
                        ],
                    ],
                    [
                        'title' => 'Lead talent',
                        'description' => 'Senior leadership placements for strategic growth and transformation.',
                        'image' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'VP of People', 'description' => 'Scale global people strategy and leadership hiring.', 'link' => '/jobs/vp-of-people'],
                            ['title' => 'Operations Director', 'description' => 'Drive operational excellence across distributed teams.', 'link' => '/jobs/operations-director'],
                        ],
                    ],
                    [
                        'title' => 'Finance',
                        'description' => 'Analysts, controllers, and finance teams ready to scale.',
                        'image' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Finance Operations Lead', 'description' => 'Manage multi-currency payroll and forecasting cycles.', 'link' => '/jobs/finance-operations-lead'],
                            ['title' => 'Senior Accountant', 'description' => 'Maintain compliance and audit readiness.', 'link' => '/jobs/senior-accountant'],
                        ],
                    ],
                    [
                        'title' => 'HR hiring',
                        'description' => 'HR professionals to improve employee engagement and retention.',
                        'image' => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Global HR Partner', 'description' => 'Lead onboarding and compliance programs across regions.', 'link' => '/jobs/global-hr-partner'],
                            ['title' => 'Talent Acquisition Lead', 'description' => 'Build pipelines and optimize hiring performance.', 'link' => '/jobs/talent-acquisition-lead'],
                        ],
                    ],
                    [
                        'title' => 'Web design & branding',
                        'description' => 'Creative teams that bring your digital presence to life.',
                        'image' => 'https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Brand Designer', 'description' => 'Craft visual systems and brand identity assets.', 'link' => '/jobs/brand-designer'],
                            ['title' => 'Product UI Designer', 'description' => 'Design conversion-focused web and product experiences.', 'link' => '/jobs/product-ui-designer'],
                        ],
                    ],
                    [
                        'title' => 'Help desk',
                        'description' => 'Support agents ready to help your customers 24/7.',
                        'image' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Customer Support Manager', 'description' => 'Scale distributed support teams with KPI coaching.', 'link' => '/jobs/customer-support-manager'],
                            ['title' => 'Support Team Lead', 'description' => 'Guide frontline teams and elevate customer satisfaction.', 'link' => '/jobs/support-team-lead'],
                        ],
                    ],
                    [
                        'title' => 'Digital marketing',
                        'description' => 'Campaign experts to drive growth across channels.',
                        'image' => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Marketing Growth Specialist', 'description' => 'Optimize acquisition campaigns and lifecycle messaging.', 'link' => '/jobs/marketing-growth-specialist'],
                            ['title' => 'Lifecycle Marketing Manager', 'description' => 'Build retention and engagement programs.', 'link' => '/jobs/lifecycle-marketing-manager'],
                        ],
                    ],
                    [
                        'title' => 'Administrative support',
                        'description' => 'Reliable admins to keep daily operations smooth.',
                        'image' => 'https://images.unsplash.com/photo-1521791055366-0d553872125f?q=80&w=600&auto=format&fit=crop',
                        'jobs' => [
                            ['title' => 'Executive Assistant', 'description' => 'Support leadership with calendar and travel management.', 'link' => '/jobs/executive-assistant'],
                            ['title' => 'Operations Coordinator', 'description' => 'Keep daily workflows on track across teams.', 'link' => '/jobs/operations-coordinator'],
                        ],
                    ],
                ],
                'modal_roles' => [
                    ['title' => 'Global HR Partner', 'description' => 'Lead onboarding and compliance programs across APAC and EMEA teams.'],
                    ['title' => 'Finance Operations Lead', 'description' => 'Manage multi-currency payroll, forecasting, and reporting cycles.'],
                    ['title' => 'Customer Support Manager', 'description' => 'Scale distributed support teams with KPI-driven coaching.'],
                    ['title' => 'Marketing Growth Specialist', 'description' => 'Optimize acquisition campaigns and lifecycle messaging worldwide.'],
                ],
            ],
        ]);

        PageSection::updateOrCreate(['section' => 'industries'], [
            'content' => [
                'title' => 'Industries we support',
                'subtitle' => 'Specialist talent across verticals, from operations and engineering to hospitality and healthcare.',
                'items' => [
                    ['title' => 'Data Management', 'description' => 'Data engineers, analysts, and BI teams for insight-driven decisions.'],
                    ['title' => 'Travel', 'description' => 'Operations and service staff for high-volume travel programs.'],
                    ['title' => 'Healthcare', 'description' => 'Clinical coordinators, admin, and compliance roles.'],
                    ['title' => 'Engineering', 'description' => 'Technical experts supporting product and infrastructure teams.'],
                    ['title' => 'Hospitality', 'description' => 'Front-of-house, guest services, and operations teams.'],
                    ['title' => 'Airport Services', 'description' => 'Ground handling, logistics, and passenger support teams.'],
                    ['title' => 'Mining', 'description' => 'Safety, operational, and technical support professionals.'],
                    ['title' => 'Wedding & Event Planning', 'description' => 'Event producers and staffing partners for flawless delivery.'],
                    ['title' => 'Technical Support', 'description' => 'Helpdesk teams for product and customer success.'],
                    ['title' => 'Legal', 'description' => 'Paralegals and compliance experts across jurisdictions.'],
                    ['title' => 'Recruitment', 'description' => 'Recruiters and coordinators to expand your talent funnel.'],
                    ['title' => 'Virtual Assistant', 'description' => 'Organized support roles for executive and team workflows.'],
                ],
            ],
        ]);

        PageSection::updateOrCreate(['section' => 'cta'], [
            'content' => [
                'title' => 'Get Started',
                'subtitle' => "We're here to help.",
                'button_text' => "Let's Talk",
                'cards' => [
                    [
                        'title' => 'Connect with us',
                        'description' => 'Reach our advisors for a tailored staffing strategy.',
                        'contact' => 'info@stafflink.pro',
                        'contact_type' => 'email',
                    ],
                    [
                        'title' => 'Chat with us',
                        'description' => 'Fast answers from our on-call team in minutes.',
                        'contact' => 'Mon-Fri, 8 AM - 5 PM',
                        'contact_type' => 'hours',
                    ],
                    [
                        'title' => 'Partner with us',
                        'description' => 'Discover how we can create meaningful opportunities together. Contact our team today to learn more.',
                        'contact' => '',
                        'contact_type' => 'none',
                    ],
                ],
            ],
        ]);
    }
}
