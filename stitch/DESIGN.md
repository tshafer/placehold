# Design System Strategy: Neon Synth Editorial

## 1. Overview & Creative North Star
The Creative North Star for this design system is **"The Kinetic Terminal."** 

This is not a static developer tool; it is a living, breathing environment that captures the energy of a high-performance engine. We are moving beyond the "SaaS-standard" dashboard by blending high-end editorial layouts with the raw, electrified aesthetic of a synth-wave terminal. By utilizing aggressive typography scales, intentional asymmetry, and depth created through light rather than lines, we create a workspace that feels premium, urgent, and precise.

To break the "template" look, layouts must embrace **Spacious Asymmetry**. Use the `20` (7rem) and `24` (8.5rem) spacing tokens to create massive gutters that push content into focused, high-impact zones. Overlap monospace data readouts across large display headings to create a sense of layered complexity.

---

## 2. Colors & Atmospheric Depth
Our palette is rooted in the "Obsidian" depth of `surface` (#0c1322), punctuated by the "electric" energy of `secondary` (#ddb7ff) and `tertiary` (#2fd9f4).

### The "No-Line" Rule
Standard 1px borders are strictly prohibited for sectioning. They are the hallmark of generic design. In this system, boundaries are defined exclusively by:
*   **Tonal Shifts:** Transitioning from `surface_container_low` (#141b2b) to `surface_container` (#191f2f).
*   **Glow-Bleed:** Using a 1px `outline_variant` (#414754) at **15% opacity** only when a structural break is functionally required for accessibility.

### Surface Hierarchy & Nesting
Treat the UI as a physical stack of semi-conductive glass. 
*   **The Foundation:** Use `surface_dim` (#0c1322) for the global canvas.
*   **The Content Blocks:** Use `surface_container_low` (#141b2b) for secondary panels.
*   **The Active Focus:** Use `surface_container_highest` (#2e3545) for active code editors or primary data modules to bring them "closer" to the user.

### Signature Textures (The Flux)
For primary CTAs and high-impact headers, use a linear gradient: `primary` (#abc7ff) to `primary_container` (#468fff) at a 135-degree angle. This adds a "liquid chrome" polish that flat colors lack.

---

## 3. Typography: The Digital/Editorial Hybrid
We contrast the humanistic `Inter` with the architectural precision of `Space Grotesk`.

*   **Display & Headlines (`Space Grotesk`):** These are your "vibe" setters. Use `display-lg` (3.5rem) for page titles. Tighten the letter-spacing to `-0.04em` to make the sharp terminals of the letterforms feel intentional and aggressive.
*   **The Data Layer (`Inter` / Monospace Simulation):** While the system uses `Inter`, for data-heavy readouts (logs, hashes, timestamps), utilize the `label-md` and `label-sm` tokens. Ensure these are set in Uppercase with a `+0.1em` letter-spacing to mimic terminal outputs.
*   **Hierarchy as Identity:** Use `tertiary` (#2fd9f4) for `label-sm` elements to make metadata "pop" against the obsidian background like a glowing status light.

---

## 4. Elevation & Depth: Tonal Layering
Traditional shadows are too "soft" for a developer tool. We use **Ambient Luminescence**.

*   **The Layering Principle:** Instead of shadows, nest a `surface_container_lowest` (#070e1d) card inside a `surface_container_high` (#232a3a) section to create a "recessed" look.
*   **Glassmorphism & Depth:** Floating modals or dropdowns must use a backdrop-blur of `12px` to `20px` combined with `surface_container_highest` (#2e3545) at **70% opacity**. This allows the "Neon" accents of the background to bleed through the glass.
*   **The Glow-Stroke:** For cards that are "Active" or "Running," replace the border with a `primary` (#abc7ff) outer glow: `0px 0px 12px rgba(171, 199, 255, 0.3)`.

---

## 5. Components

### Buttons: The Power Cells
*   **Primary:** A gradient fill (`primary` to `primary_container`) with white text. Roundedness: `md` (0.375rem).
*   **Secondary:** Ghost style. No background, `outline` (#8b919f) text, and a `1px` border using `outline_variant` at 40% opacity.
*   **States:** On hover, primary buttons should emit a `secondary` (#ddb7ff) glow.

### Input Fields: The Terminal Entry
*   **Styling:** Background set to `surface_container_lowest` (#070e1d). No top/left/right borders—only a `2px` bottom border using `outline_variant`. 
*   **Focus:** The bottom border transforms into a `tertiary` (#2fd9f4) glow.

### Cards: The Logic Gate
*   **No Dividers:** Use `3.5rem` (spacing 10) of vertical whitespace to separate header from body.
*   **Interaction:** Cards should subtly lift by switching background from `surface_container` to `surface_container_high` on hover.

### New Component: "The Status Beacon"
A small, circular indicator using the `secondary` (#ddb7ff) color with a CSS pulse animation. Use this next to "Live" data streams or active server instances to provide a sense of "Kinetic" energy.

---

## 6. Do's and Don'ts

### Do:
*   **Use Massive Scale:** Don't be afraid to use `display-lg` for a single word to anchor a layout.
*   **Layer Colors:** Place `on_tertiary_container` text over a `tertiary_container` background for high-contrast "Status" badges.
*   **Embrace Space:** Use the `24` (8.5rem) spacing token to separate distinct workflow sections.

### Don't:
*   **No "Boxy" Grids:** Avoid perfectly symmetrical 3-column grids. Try a 2/3 - 1/3 split with varying internal padding to create visual rhythm.
*   **No Pure Black:** Never use `#000000`. Use `surface_container_lowest` (#070e1d) to maintain the ability to layer "recessed" elements.
*   **No Default Shadows:** If you can't see the tint of the brand colors in the shadow, it's too muddy. Shadows should feel like "dark light," not gray ink.