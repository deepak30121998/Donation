<?php

namespace Database\Seeders;

use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSectionSeeder extends Seeder
{
    public function run(): void
    {
        $sections = [

            // ─── HOME ─────────────────────────────────────────────────────────
            [
                'page'        => 'home',
                'section_key' => 'hero',
                'title'       => 'Empower change, one act of kindness at a time',
                'subtitle'    => 'welcome our charity',
                'body'        => 'Join us in creating brighter futures by providing hope, delivering help, and fostering lasting change for communities in need around the world.',
                'button_text' => 'donate now',
                'button_url'  => '/donation',
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'about',
                'title'       => 'United in compassion, changing lives',
                'subtitle'    => 'about us',
                'body'        => 'Driven by compassion and a shared vision, we work hand-in-hand with communities to create meaningful change.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'services',
                'title'       => 'Our comprehensive services',
                'subtitle'    => 'services',
                'body'        => 'Our services are focused on creating lasting change through community development, healthcare access, educational support, and emergency relief.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'causes',
                'title'       => 'Supporting communities causes',
                'subtitle'    => 'our causes',
                'body'        => 'We focus on impactful causes that address urgent community needs, from healthcare and education to food security and for lasting change.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'programs',
                'title'       => 'Empowering our programs',
                'subtitle'    => 'our program',
                'body'        => 'Our programs are designed to create sustainable change by addressing community needs, empowering individuals, and promoting long-term development through education.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'donate_cta',
                'title'       => 'Donate us',
                'subtitle'    => 'donate now',
                'body'        => 'Your generous support enables us to continue our mission of spreading love and serving our community.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'testimonials',
                'title'       => 'What people say about us',
                'subtitle'    => 'testimonials',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'gallery',
                'title'       => 'Our image gallery',
                'subtitle'    => 'gallery',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'home',
                'section_key' => 'blog',
                'title'       => 'Stories of impact and hope',
                'subtitle'    => 'latest post',
                'body'        => 'Explore inspiring stories and updates about our initiatives, successes, and the lives we\'ve touched.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── ABOUT ────────────────────────────────────────────────────────
            [
                'page'        => 'about',
                'section_key' => 'hero',
                'title'       => 'About Us',
                'subtitle'    => 'Learn about our mission and values',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'approach',
                'title'       => 'Compassionate solutions for lasting impact',
                'subtitle'    => 'our approach',
                'body'        => 'Our approach focuses on creating sustainable change by addressing root causes, empowering communities, and delivering compassionate solutions.',
                'button_text' => 'contact now',
                'button_url'  => '/contact',
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'mission',
                'title'       => 'our mission',
                'subtitle'    => null,
                'body'        => 'We strive to create positive change, empower communities, and build a better world.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'vision',
                'title'       => 'our vision',
                'subtitle'    => null,
                'body'        => 'A world where every individual has access to equal opportunities and resources.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'values',
                'title'       => 'our value',
                'subtitle'    => null,
                'body'        => 'Integrity, compassion, and accountability guide everything we do.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
            [
                'page'        => 'about',
                'section_key' => 'facts',
                'title'       => 'United in compassion, changing lives',
                'subtitle'    => 'about us',
                'body'        => 'Driven by compassion and a shared vision, we work hand-in-hand with communities to create meaningful change.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── SERVICES ─────────────────────────────────────────────────────
            [
                'page'        => 'services',
                'section_key' => 'hero',
                'title'       => 'Our comprehensive services',
                'subtitle'    => 'services',
                'body'        => 'Our services are focused on creating lasting change through community development, healthcare access, educational support, and emergency relief.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── PROGRAMS ─────────────────────────────────────────────────────
            [
                'page'        => 'programs',
                'section_key' => 'hero',
                'title'       => 'Empowering our programs',
                'subtitle'    => 'our program',
                'body'        => 'Our programs are designed to create sustainable change by addressing community needs, empowering individuals, and promoting long-term development through education.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── BLOG ─────────────────────────────────────────────────────────
            [
                'page'        => 'blog',
                'section_key' => 'hero',
                'title'       => 'Stories of impact and hope',
                'subtitle'    => 'latest post',
                'body'        => 'Explore inspiring stories and updates about our initiatives, successes, and the lives we\'ve touched.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── TEAM ─────────────────────────────────────────────────────────
            [
                'page'        => 'team',
                'section_key' => 'hero',
                'title'       => 'Meet our dedicated team',
                'subtitle'    => 'our team',
                'body'        => 'Our team of passionate individuals works every day to make a difference in the lives of those who need it most.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── GALLERY ──────────────────────────────────────────────────────
            [
                'page'        => 'gallery',
                'section_key' => 'hero',
                'title'       => 'Image Gallery',
                'subtitle'    => 'gallery',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── TESTIMONIALS ─────────────────────────────────────────────────
            [
                'page'        => 'testimonials',
                'section_key' => 'hero',
                'title'       => 'What people say about us',
                'subtitle'    => 'testimonials',
                'body'        => 'Hear from the people whose lives have been touched by our work and dedication to making a lasting difference.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── DONATION ─────────────────────────────────────────────────────
            [
                'page'        => 'donation',
                'section_key' => 'hero',
                'title'       => 'Make a difference today',
                'subtitle'    => 'donate now',
                'body'        => 'Your generous support enables us to continue our mission of spreading love and serving communities in need around the world.',
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── CONTACT ──────────────────────────────────────────────────────
            [
                'page'        => 'contact',
                'section_key' => 'hero',
                'title'       => 'Get in to touch',
                'subtitle'    => 'contact us',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],

            // ─── FAQS ─────────────────────────────────────────────────────────
            [
                'page'        => 'faqs',
                'section_key' => 'hero',
                'title'       => 'Frequently Asked Questions',
                'subtitle'    => 'faqs',
                'body'        => null,
                'button_text' => null,
                'button_url'  => null,
                'is_active'   => true,
            ],
        ];

        foreach ($sections as $section) {
            PageSection::updateOrCreate(
                [
                    'page'        => $section['page'],
                    'section_key' => $section['section_key'],
                ],
                $section
            );
        }
    }
}
