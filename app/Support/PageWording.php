<?php

namespace App\Support;

use App\Models\SiteSetting;

class PageWording
{
    public static function defaults(): array
    {
        return [
            'blog' => [
                'badge' => 'Blog',
                'title_line_1' => 'Insights for Hiring',
                'title_line_2' => 'and Workforce Growth',
                'intro' => 'Practical guides and updates from StaffLink to help you build better teams and make faster hiring decisions.',
                'latest_heading' => 'Latest Articles',
                'empty_heading' => 'No blog posts published yet',
                'empty_subtitle' => 'Please check back soon for updates.',
            ],
            'blog_show' => [
                'back_to_blog' => 'Back to blog',
                'related_heading' => 'Related Articles',
            ],
            'jobs' => [
                'badge' => 'Careers',
                'title' => 'Available Jobs',
                'subtitle' => 'Explore our current openings posted by StaffLink admin team. Find the right role and apply now.',
            ],
            'appointment' => [
                'badge' => 'Schedule Appointment',
                'title' => 'Book a consultation',
                'subtitle' => 'Select a date from the calendar, then choose an available time slot in the popup. Each session lasts 1 hour.',
            ],
            'application' => [
                'badge' => 'Careers',
                'title' => 'Apply now',
                'subtitle' => 'Please complete this form and upload your required documents. Your application will be sent to careers@stafflink.pro and securely saved in our database for recruitment processing.',
            ],
            'contact' => [
                'badge' => 'Contact us',
                'title' => 'Contact us',
                'subtitle' => 'Simply fill out the form, and we will promptly respond to your enquiry.',
            ],
            'who_we_are' => [
                'badge' => 'Who We Are',
                'title_line_1' => 'Your Global Talent',
                'title_line_2' => 'Outsourcing Partner',
                'subtitle' => 'StaffLink Solutions delivers practical, reliable staffing support to businesses that need strong teams fast. We focus on quality hiring, consistent communication, and long-term partnerships that help you scale with confidence.',
            ],
            'what_we_offer' => [
                'badge' => 'What We Offer',
                'title' => 'Stafflink: Revolutionising Global Talent Solutions',
                'subtitle' => 'The success of your business is our success. As we unlock the full potential of people, we help enterprises grow.',
            ],
            'our_people' => [
                'title' => 'Meet Your Team',
                'subtitle' => 'Business growth starts with strong people. We build dedicated offshore teams that align with your goals, your company culture, and your quality standards.',
            ],
            'our_purpose' => [
                'title' => 'Our Purpose & Business Principles',
            ],
            'nanny_concierge' => [
                'badge' => 'Airport Services',
                'title' => 'International Childcare Recruitment Agency',
            ],
            'sitemap' => [
                'badge' => 'Sitemap',
                'title' => 'Explore All Service Links',
                'subtitle' => 'Quick access to all services, categories, roles, and service pages by area.',
                'services_heading' => 'Service Links',
                'areas_heading' => 'Service per Area',
            ],
        ];
    }

    public static function all(): array
    {
        $stored = SiteSetting::getValue('page_wordings', []);

        if (!is_array($stored)) {
            $stored = [];
        }

        return array_replace_recursive(static::defaults(), $stored);
    }

    public static function for(string $page): array
    {
        $all = static::all();

        return $all[$page] ?? [];
    }

    public static function update(array $wordings): void
    {
        SiteSetting::setValue('page_wordings', $wordings);
    }

    public static function pageKeys(): array
    {
        return array_keys(static::defaults());
    }
}
