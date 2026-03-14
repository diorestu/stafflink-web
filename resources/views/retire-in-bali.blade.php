<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.gtag-head')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('partials.seo-meta', [
        'seoTitle' => \App\Models\SiteSetting::siteName().' | Retire in Bali with Confidence',
        'seoDescription' => 'Structured retirement relocation support in Bali covering visa guidance, property coordination, healthcare orientation, daily life setup, and long-term integration.',
        'seoKeywords' => 'retire in bali, bali retirement support, retirement visa bali, move to bali retirement',
    ])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f4f1eb] text-[#1f2a24]">
    @include('partials.gtm-noscript')
    <div class="min-h-screen">
        <x-site-header />

        <main class="px-5 pb-20 pt-8 lg:px-10">
            <section class="mx-auto max-w-6xl space-y-8">
                <section class="overflow-hidden rounded-[28px] bg-[linear-gradient(135deg,#173a2b_0%,#26624a_58%,#d5b66a_100%)] px-7 py-10 text-white shadow-[0_20px_60px_rgba(23,58,43,0.2)] lg:px-10 lg:py-14">
                    <div class="grid gap-8 lg:grid-cols-[1.18fr_0.82fr] lg:items-end">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.28em] text-white/70">Featured Service</p>
                            <h1 class="mt-4 max-w-4xl text-4xl font-semibold leading-tight sm:text-5xl lg:text-6xl">Retire in Bali with Confidence</h1>
                            <p class="mt-5 max-w-3xl text-base leading-relaxed text-white/88 sm:text-lg">
                                Retiring in Bali offers an exceptional lifestyle, warm climate, vibrant communities, and a significantly lower cost of living compared to many Western countries. However, relocating for retirement requires careful planning, legal clarity, and reliable local support.
                            </p>
                            <p class="mt-4 max-w-3xl text-base leading-relaxed text-white/82">
                                Our Retire in Bali service is designed to help you transition smoothly, safely, and comfortably. From visa guidance and property coordination to daily life setup and long-term integration, we provide structured assistance every step of the way.
                            </p>
                            <div class="mt-7 flex flex-wrap gap-3">
                                <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-white bg-white px-6 py-3 text-sm font-semibold text-[#173a2b] transition hover:bg-transparent hover:text-white">Contact Us to Begin Planning</a>
                                <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#173a2b]">Book a Retirement Consultation</a>
                            </div>
                        </div>
                        <div class="grid gap-4 rounded-[24px] bg-white/10 p-5 backdrop-blur-sm">
                            <div class="rounded-[20px] border border-white/15 bg-black/10 px-5 py-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/70">Core Support</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/90">Visa guidance, property coordination, healthcare orientation, and practical life setup.</p>
                            </div>
                            <div class="rounded-[20px] border border-white/15 bg-black/10 px-5 py-4">
                                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-white/70">Long-Term Stability</p>
                                <p class="mt-2 text-sm leading-relaxed text-white/90">Structured support to help retirement in Bali feel secure, sustainable, and well-prepared.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Why Consider Retiring in Bali?</h2>
                    <p class="mt-4 text-base leading-relaxed text-[#46534d]">Bali has become a preferred retirement destination for Australians, Europeans, and global expats seeking a balanced lifestyle.</p>
                    <h3 class="mt-6 text-lg font-semibold text-[#1f5f46]">Key benefits include:</h3>
                    <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-3">
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Lower overall living expenses</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Access to private international-standard healthcare</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Established expat communities</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Modern villa and residential living options</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Availability of domestic support staff</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Relaxed tropical environment year-round</div>
                    </div>
                    <p class="mt-6 text-sm leading-relaxed text-[#46534d]">With proper preparation, retirement in Bali can offer both financial efficiency and lifestyle enhancement.</p>
                </section>

                <section class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Our Retirement Support Services</h2>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-[#46534d]">We provide practical, on-the-ground assistance tailored to your stage of planning, whether you are exploring options or preparing for immediate relocation.</p>
                    <div class="mt-8 grid gap-5 lg:grid-cols-2">
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-6">
                            <h3 class="text-xl font-semibold text-[#1f5f46]">Retirement Visa Guidance</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Understanding visa options is one of the most important steps.</p>
                            <p class="mt-4 text-sm font-semibold text-[#173a2b]">We assist with:</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#46534d]">
                                <li>Identifying suitable retirement visa pathways</li>
                                <li>Clarifying eligibility requirements</li>
                                <li>Document preparation guidance</li>
                                <li>Renewal and compliance considerations</li>
                                <li>Coordination with trusted legal professionals</li>
                            </ul>
                            <p class="mt-4 text-sm leading-relaxed text-[#46534d]">Our goal is to ensure your relocation is legally structured and secure.</p>
                        </article>
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-6">
                            <h3 class="text-xl font-semibold text-[#1f5f46]">Property & Living Arrangements</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Choosing the right location and property directly impacts your retirement experience.</p>
                            <p class="mt-4 text-sm font-semibold text-[#173a2b]">We assist with:</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#46534d]">
                                <li>Area selection based on lifestyle preferences</li>
                                <li>Long-term rental or lease coordination</li>
                                <li>Understanding local regulations</li>
                                <li>Utility and essential service setup</li>
                                <li>Property-related documentation support</li>
                            </ul>
                            <p class="mt-4 text-sm leading-relaxed text-[#46534d]">Whether you prefer coastal living, community-centered neighborhoods, or quieter areas, we help align your lifestyle with the right location.</p>
                        </article>
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-6">
                            <h3 class="text-xl font-semibold text-[#1f5f46]">Healthcare & Insurance Orientation</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Peace of mind is essential in retirement.</p>
                            <p class="mt-4 text-sm font-semibold text-[#173a2b]">We provide guidance on:</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#46534d]">
                                <li>Private hospitals and medical facilities</li>
                                <li>Health insurance considerations</li>
                                <li>Emergency planning overview</li>
                                <li>Understanding local healthcare systems</li>
                            </ul>
                            <p class="mt-4 text-sm leading-relaxed text-[#46534d]">Our role is to help you feel informed and prepared.</p>
                        </article>
                        <article class="rounded-[22px] border border-[#d8e6de] bg-[#f7faf8] p-6">
                            <h3 class="text-xl font-semibold text-[#1f5f46]">Household & Daily Life Setup</h3>
                            <p class="mt-3 text-sm leading-relaxed text-[#46534d]">Settling in comfortably requires more than securing a property.</p>
                            <p class="mt-4 text-sm font-semibold text-[#173a2b]">We assist with:</p>
                            <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#46534d]">
                                <li>Airport arrival coordination</li>
                                <li>Hiring domestic staff (housekeepers, drivers, assistants)</li>
                                <li>Banking and practical daily setup guidance</li>
                                <li>SIM cards and communication arrangements</li>
                                <li>Ongoing concierge-style support</li>
                            </ul>
                            <p class="mt-4 text-sm leading-relaxed text-[#46534d]">This ensures your transition into daily life is smooth and stress-free.</p>
                        </article>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-2">
                    <article class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h3 class="text-2xl font-semibold leading-tight text-[#173a2b]">Neighbourhood & Community Integration</h3>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">Successful retirement abroad goes beyond logistics, it is about connection.</p>
                        <p class="mt-4 text-sm font-semibold text-[#173a2b]">We support you with:</p>
                        <ul class="mt-3 space-y-2 text-sm leading-relaxed text-[#46534d]">
                            <li>Introduction to established expat communities</li>
                            <li>Cultural orientation</li>
                            <li>Social groups and activity recommendations</li>
                            <li>Local service provider navigation</li>
                        </ul>
                        <p class="mt-4 text-sm leading-relaxed text-[#46534d]">Integration helps transform relocation into a fulfilling long-term lifestyle.</p>
                    </article>
                    <article class="rounded-[24px] border border-[#d7c18a] bg-[#fff9ea] p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                        <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Who This Service Is For</h2>
                        <p class="mt-4 text-base leading-relaxed text-[#46534d]">Our Retire in Bali support is suitable for:</p>
                        <div class="mt-6 grid gap-3">
                            <div class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Foreigner retirees considering Southeast Asia</div>
                            <div class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Couples planning semi-retirement abroad</div>
                            <div class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Individuals seeking part-year living in Bali</div>
                            <div class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Families assisting parents with relocation</div>
                            <div class="rounded-2xl border border-[#ead9ab] bg-white/70 px-4 py-3 text-sm font-semibold text-[#5a4b24]">Expats looking for structured transition support</div>
                        </div>
                        <p class="mt-5 text-sm leading-relaxed text-[#46534d]">We tailor our approach depending on your timeline and level of involvement required.</p>
                    </article>
                </section>

                <section class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Why Work With Us?</h2>
                    <p class="mt-4 text-base leading-relaxed text-[#46534d]">Relocating overseas involves multiple moving parts: legal, property, lifestyle, and practical logistics.</p>
                    <p class="mt-4 text-sm font-semibold text-[#173a2b]">We provide coordinated support across:</p>
                    <div class="mt-5 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Relocation guidance</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Property coordination</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Domestic staffing</div>
                        <div class="rounded-2xl border border-[#e3ebe6] bg-[#f9fbfa] px-4 py-4 text-sm font-medium text-[#25332d]">Concierge and lifestyle services</div>
                    </div>
                    <p class="mt-6 text-sm leading-relaxed text-[#46534d]">Working with one structured team reduces complexity and ensures consistency throughout your transition.</p>
                </section>

                <section class="rounded-[24px] bg-white p-7 shadow-[0_14px_40px_rgba(16,24,40,0.08)] lg:p-9">
                    <h2 class="text-3xl font-semibold leading-tight text-[#173a2b]">Frequently Asked Questions</h2>
                    <div class="mt-6 space-y-4">
                        <article class="rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] p-5">
                            <h4 class="text-lg font-semibold text-[#1f5f46]">Is retiring in Bali legal for foreigners?</h4>
                            <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Yes, provided the correct visa and regulatory requirements are met. Proper documentation and compliance are essential.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] p-5">
                            <h4 class="text-lg font-semibold text-[#1f5f46]">Can foreigners own property in Bali?</h4>
                            <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Foreign ownership structures are regulated. We coordinate with qualified professionals to guide you through available legal options.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] p-5">
                            <h4 class="text-lg font-semibold text-[#1f5f46]">What is the average cost of living for retirees in Bali?</h4>
                            <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Costs vary depending on lifestyle, accommodation choice, and level of support services. Bali often offers a lower cost structure compared to major Australian cities.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] p-5">
                            <h4 class="text-lg font-semibold text-[#1f5f46]">Is healthcare reliable?</h4>
                            <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Private hospitals and clinics in Bali provide high-quality services, and many retirees maintain international health insurance coverage.</p>
                        </article>
                        <article class="rounded-2xl border border-[#dfe8e3] bg-[#f9fbfa] p-5">
                            <h4 class="text-lg font-semibold text-[#1f5f46]">How long should I plan before relocating?</h4>
                            <p class="mt-2 text-sm leading-relaxed text-[#46534d]">Planning typically begins several months in advance, depending on visa type and personal preparation requirements.</p>
                        </article>
                    </div>
                </section>

                <section class="rounded-[28px] bg-[#173a2b] px-7 py-9 text-white shadow-[0_20px_50px_rgba(23,58,43,0.2)] lg:px-10 lg:py-11">
                    <p class="text-xs font-semibold uppercase tracking-[0.24em] text-white/65">Start Planning Your Retirement in Bali</p>
                    <h2 class="mt-3 text-3xl font-semibold leading-tight sm:text-4xl">Retirement should feel secure, exciting, and well-prepared, not overwhelming.</h2>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-white/82">If you are considering Bali for your next chapter, our team can provide structured guidance and practical support to help you move forward with clarity and confidence.</p>
                    <p class="mt-4 max-w-4xl text-base leading-relaxed text-white/82">Contact us to begin your retirement planning consultation.</p>
                    <div class="mt-7 flex flex-wrap gap-3">
                        <a href="{{ route('contact') }}" class="inline-flex rounded-full border-2 border-[#d5b66a] bg-[#d5b66a] px-6 py-3 text-sm font-semibold text-[#173a2b] transition hover:bg-transparent hover:text-[#d5b66a]">Contact Us</a>
                        <a href="{{ route('appointments.create') }}" class="inline-flex rounded-full border-2 border-white/80 px-6 py-3 text-sm font-semibold text-white transition hover:bg-white hover:text-[#173a2b]">Book a Consultation</a>
                    </div>
                </section>
            </section>
        </main>

        <x-site-footer />
    </div>
</body>
</html>
