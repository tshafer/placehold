import { z } from "zod";
import { placeholdUrl } from "../client.js";

const sizeSchema = z.string().regex(/^\d+x\d+$|^\d+$/, "e.g. 640x320 or 300").describe("Dimensions: WxH or square N");
const hexSchema = z.string().regex(/^[0-9A-Fa-f]{6}$/).optional().describe("Hex color without #");
const formatSchema = z.enum(["png", "jpg", "jpeg", "gif", "webp", "avif", "bmp", "ico", "svg"]).optional();

const imageInputSchema = z.object({
  size: sizeSchema,
  text: z.string().max(100).optional().describe("Text overlay on the image"),
  bg: hexSchema,
  fg: hexSchema,
  format: formatSchema,
});

export const placehold_image = {
  name: "placehold_image",
  title: "Generate placeholder image URL",
  description: `Generate a placeholder image URL from placehold.cloud. Use for mockups, wireframes, or temporary images. Returns the URL; the AI or user can embed it. Do not use for user-uploaded or real content.`,
  inputSchema: imageInputSchema,
  async handler(args: z.infer<typeof imageInputSchema>) {
    const sizePath = /^\d+$/.test(args.size) ? `${args.size}x${args.size}` : args.size;
    const params: Record<string, string> = {};
    if (args.text) params.text = args.text;
    if (args.bg) params.bg = args.bg;
    if (args.fg) params.fg = args.fg;
    if (args.format) params.format = args.format;
    const url = placeholdUrl(`/${sizePath}`, params);
    return {
      content: [{ type: "text" as const, text: `Placeholder image: ${url}` }],
      structuredContent: { url, size: args.size },
    };
  },
};
