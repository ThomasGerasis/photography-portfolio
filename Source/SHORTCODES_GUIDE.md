# Shortcodes Guide — Vasakos Photography

This guide is for the content team. It explains what shortcodes are, how to use them inside WordPress, and documents every shortcode available in our theme.

---

## What Is a Shortcode?

A **shortcode** is a small tag you type into a page or post in the WordPress editor that gets replaced with a fully built component when the page is viewed. They look like this:

```
[shortcode_name attribute="value"]
```

Think of them as reusable content blocks. Instead of building a pricing table or gallery from scratch every time, you just drop in the shortcode and it renders automatically.

---

## How to Insert a Shortcode

### Method 1 — Using the Toolbar Button (Recommended)
1. Open any page or post in the **Classic Editor**
2. Look for the **"Shortcodes"** dropdown button in the editor toolbar
3. Select the shortcode you want from the list
4. A popup will appear with all the available options for that shortcode
5. Fill in the fields and click **Insert** — the shortcode is added automatically

### Method 2 — Typing It Manually
Type the shortcode directly into the editor. Use the reference below for the correct attribute names and values.

> **Tip:** You can double-click an existing shortcode in the editor to reopen the popup and edit its settings.

---

## Quick Reference

| Shortcode | What It Does |
|-----------|-------------|
| [`[button]`](#button) | A styled link/button |
| [`[banner_image]`](#banner_image) | Full-width hero banner with image and optional CTA |
| [`[photo_gallery]`](#photo_gallery) | Masonry photo gallery with lightbox |
| [`[photoshoots_categories]`](#photoshoots_categories) | Grid of category cards |
| [`[pricing_packages]`](#pricing_packages) | Pricing package cards |
| [`[faq]`](#faq) | Collapsible FAQ accordion |
| [`[why_choose_me]`](#why_choose_me) | "Why Choose Me" feature cards |
| [`[contact_form]`](#contact_form) | Contact form with optional package selector |
| [`[airbnb_reviews]`](#airbnb_reviews) | Embedded Airbnb/TrustIndex reviews widget |
| [`[target_audience]`](#target_audience) | "Who This Is For" section with list |
| [`[video_embed]`](#video_embed) | Responsive YouTube or Vimeo embed |
| [`[timeline]`](#timeline) | Numbered step-by-step timeline |
| [`[cta_section]`](#cta_section) | Full-width call-to-action section |
| [`[stats_bar]`](#stats_bar) | Key metrics/statistics bar |
| [`[book_now_button]`](#book_now_button) | Book Now button or package dropdown |

---

## Shortcode Reference

---

### `[button]` {#button}

Renders a styled button that links to any URL.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `text` | Any text | `Click Here` | The button label |
| `link` | Any URL | `#` | Where the button links to |
| `style` | `primary` `secondary` `outline-primary` `outline-secondary` | `primary` | Visual style of the button |
| `align` | `left` `center` `right` | `left` | Horizontal alignment |
| `target` | `_self` `_blank` | `_self` | `_blank` opens in a new tab |

**Example:**
```
[button text="Book a Session" link="/contact" style="primary" align="center" target="_self"]
```

---

### `[banner_image]` {#banner_image}

A full-width hero banner with a background image, heading, subtitle, and an optional button.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `image` | Image URL | *(empty)* | Background image URL (required) |
| `title` | Any text | *(empty)* | Main heading |
| `subtitle` | Any text | *(empty)* | Text below the heading |
| `title_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h2` | HTML tag for the title |
| `overlay` | `yes` `no` | `yes` | Dark overlay on the image |
| `min_height` | CSS value | `400px` | Minimum height of the banner |
| `show_button` | `yes` `no` | `no` | Whether to show a button |
| `button_text` | Any text | `Learn More` | Button label |
| `button_link` | Any URL | `#` | Button link |
| `button_style` | `primary` `secondary` `outline-primary` `outline-secondary` `light` | `primary` | Button style |

**Example:**
```
[banner_image image="https://example.com/hero.jpg" title="Wedding Photography" subtitle="Capturing your story" show_button="yes" button_text="View Packages" button_link="/pricing" overlay="yes" min_height="500px"]
```

---

### `[photo_gallery]` {#photo_gallery}

Displays a masonry photo gallery with a lightbox popup. Photos are pulled from the site's photo library.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `category` | Category slug | *(empty = all)* | Filter by photoshoots category |
| `limit` | Number | Site default | How many photos to show |
| `load_more` | `yes` `no` | `no` | Enable infinite scroll / load more |
| `title` | Any text | *(empty)* | Optional section heading |
| `title_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h2` | Tag for the title |

**Examples:**
```
[photo_gallery]

[photo_gallery category="weddings" limit="12" load_more="yes" title="Wedding Gallery"]
```

> **Note:** Category slugs can be found in **WordPress Admin → Photoshoots → Categories**.

---

### `[photoshoots_categories]` {#photoshoots_categories}

Displays a grid of category cards (e.g. Weddings, Engagements, Portraits), each with a background image linking to the category archive.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `limit` | Number | `4` | Number of categories to show |
| `orderby` | `count` `name` `slug` | `count` | How to sort the categories |
| `categories` | Comma-separated slugs | *(empty)* | Show specific categories only (overrides limit/orderby) |

**Examples:**
```
[photoshoots_categories limit="6" orderby="name"]

[photoshoots_categories categories="weddings,engagements,portraits"]
```

---

### `[pricing_packages]` {#pricing_packages}

Renders pricing package cards. Package data (price, duration, description, etc.) is managed in **WordPress Admin → Pricing Packages**.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `ids` | Comma-separated IDs | *(empty = all)* | Show specific packages by post ID |
| `title` | Any text | *(empty)* | Section heading |
| `subtitle` | Any text | `Choose the perfect package for you` | Section subheading |
| `title_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h2` | Tag for the title |
| `show_book_button` | `yes` `no` | `yes` | Show "Book Now" button on each card |

**Examples:**
```
[pricing_packages]

[pricing_packages ids="12,34,56" title="Wedding Packages" subtitle="Find your perfect fit" show_book_button="yes"]
```

> **Note:** Package post IDs can be found in the URL when editing a package in the admin (e.g. `post=42`).

---

### `[faq]` {#faq}

Displays a collapsible accordion FAQ section. FAQ items are managed via the page's meta fields or the category's meta fields — not typed directly into the shortcode.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `title` | Any text | `Frequently Asked Questions` | Section heading |
| `subtitle` | Any text | `What people ask` | Section subheading |
| `page_id` | Page ID | *(current page)* | Pull FAQs from a specific page |

**Examples:**
```
[faq]

[faq page_id="123" title="Got Questions?" subtitle="We have answers"]
```

> **Note:** On category/taxonomy archive pages, FAQs are pulled automatically from the category's own meta fields.

---

### `[why_choose_me]` {#why_choose_me}

A grid of feature cards explaining why someone should book with you. Card content (icon, title, description) is managed in the page or category meta fields.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `title` | Any text | `Why Choose Me` | Section heading |
| `page_id` | Page ID | *(current page)* | Pull cards from a specific page |
| `category_id` | Category ID | *(empty)* | Pull cards from a specific category (overrides page_id) |

**Examples:**
```
[why_choose_me]

[why_choose_me title="Why Book With Me?" page_id="42"]

[why_choose_me category_id="5"]
```

---

### `[contact_form]` {#contact_form}

Renders the contact form (name, email, message). Optionally includes a package selector dropdown. Social links are pulled automatically from the site settings.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `show_packages` | `yes` `no` | `no` | Include a package selection dropdown |

**Examples:**
```
[contact_form]

[contact_form show_packages="yes"]
```

---

### `[airbnb_reviews]` {#airbnb_reviews}

Embeds the TrustIndex Airbnb reviews widget. The Airbnb URL is configured in the site settings — no options needed.

**Usage:**
```
[airbnb_reviews]
```

---

### `[target_audience]` {#target_audience}

A two-column section with a heading, intro text, a bulleted list, and an optional image on the right. Great for "Who this is for" or "Is this right for you?" sections.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `heading` | Any text | `Who this is for` | Main heading |
| `subheading` | Any text | *(empty)* | Secondary heading |
| `intro` | Any text | *(empty)* | Introductory paragraph |
| `items` | Comma-separated list | *(empty)* | List items (separated by commas) |
| `icon` | `check` `arrow` `dot` | `check` | Icon style for list items |
| `image` | Image URL | *(empty)* | Optional photo on the right side |

**Example:**
```
[target_audience heading="Perfect For" subheading="All kinds of couples" intro="Our photography is ideal for:" items="Engaged couples,Anniversary shoots,Proposals,Elopements" icon="check" image="https://example.com/couple.jpg"]
```

---

### `[video_embed]` {#video_embed}

Embeds a responsive YouTube or Vimeo video. Paste any standard video URL and it handles the rest.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `url` | YouTube or Vimeo URL | *(empty)* | The video URL (required) |
| `title` | Any text | *(empty)* | Optional heading above the video |
| `title_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h3` | Tag for the title |
| `ratio` | `16x9` `4x3` `1x1` | `16x9` | Aspect ratio of the video player |
| `caption` | Any text | *(empty)* | Optional caption below the video |

**Supported URL formats:**
- `https://youtu.be/VIDEO_ID`
- `https://www.youtube.com/watch?v=VIDEO_ID`
- `https://vimeo.com/VIDEO_ID`

**Example:**
```
[video_embed url="https://youtu.be/dQw4w9WgXcQ" title="Behind The Scenes" ratio="16x9" caption="Filmed on location in Edinburgh"]
```

---

### `[timeline]` {#timeline}

A numbered list of steps or stages, useful for explaining a booking process or session journey.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `title` | Any text | *(empty)* | Section heading |
| `title_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h2` | Tag for the title |
| `items` | See format below | *(empty)* | Steps to display |

**Item format:** Each step is `Title:Description`, separated by commas.

**Example:**
```
[timeline title="How It Works" items="Get in Touch:Fill out the contact form and tell us your vision,The Session:We meet on location for your shoot,Gallery Delivery:Edited photos delivered within 3 weeks"]
```

> **Note:** Commas split steps, and the first colon splits the title from the description. Descriptions can contain colons — only the *first* colon is used as the separator.

---

### `[cta_section]` {#cta_section}

A full-width call-to-action section with a heading, body text, and button. Supports solid colour or image backgrounds.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `heading` | Any text | *(empty)* | Main CTA heading |
| `heading_tag` | `h1` `h2` `h3` `h4` `p` `none` | `h2` | Tag for the heading |
| `text` | Any text | *(empty)* | Supporting paragraph |
| `button_text` | Any text | `Get in Touch` | Button label |
| `button_link` | Any URL | `#contact` | Button link |
| `button_style` | `light` `dark` `outline-light` `outline-dark` | `light` | Button style |
| `background` | `light` `dark` or image URL | `dark` | Background colour or image |
| `align` | `center` `left` | `center` | Content alignment |

**Examples:**
```
[cta_section heading="Ready to book?" text="Let's create something beautiful together." button_text="Contact Me" button_link="/contact" background="dark" align="center"]

[cta_section heading="Book Your Session" background="https://example.com/cta-bg.jpg" button_style="outline-light"]
```

---

### `[stats_bar]` {#stats_bar}

A horizontal bar displaying key statistics or metrics — great for social proof.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `items` | See format below | *(empty)* | Stats to display (required) |
| `background` | `light` `dark` `transparent` | `light` | Background style |

**Item format:** Each stat is `Value:Label`, separated by commas.

**Example:**
```
[stats_bar items="200+:Weddings Captured,8:Years Experience,5★:Average Rating,48hrs:Photo Delivery" background="dark"]
```

---

### `[book_now_button]` {#book_now_button}

A "Book Now" button or dropdown that links to the contact form and optionally pre-selects a package. 

> **Note:** This shortcode is not available in the editor toolbar — it must be typed manually.

| Attribute | Options | Default | Description |
|-----------|---------|---------|-------------|
| `type` | `single` `dropdown` | `single` | Single button or package selector dropdown |
| `text` | Any text | `Book Now` | Button label |
| `align` | `left` `center` `right` | `left` | Alignment |
| `target` | `#contactForm` or URL | `#contactForm` | ID of the contact form on the page |
| `package_id` | Package post ID | *(empty)* | *(Single mode)* Pre-selects this package |
| `page_id` | Page ID | *(empty)* | *(Dropdown mode)* Page to pull packages from |
| `class` | CSS classes | `alime-btn bg-secondary` | Custom CSS classes |

**Single button example:**
```
[book_now_button type="single" package_id="42" text="Book This Package" align="center"]
```

**Dropdown example:**
```
[book_now_button type="dropdown" text="Choose a Package" page_id="123" align="center"]
```

---

## Tips for the Content Team

- **Don't worry about quotes:** You can use straight quotes (`"`) around attribute values — both single and double quotes work.
- **Commas in timeline/stats items:** The comma is the separator between items. If your content contains a comma, it may break the list — rephrase to avoid it.
- **Image URLs:** Use the WordPress Media Library to upload images first, then copy the URL and paste it into the shortcode attribute.
- **Page/Category IDs:** When in the admin, look at the URL bar — `post=42` or `tag_ID=5` tells you the ID.
- **Testing:** After inserting a shortcode, use **Preview** to check how it looks before publishing.
