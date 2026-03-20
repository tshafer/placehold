import { z } from "zod";
import { placeholdFetch } from "../client.js";

const colorsInputSchema = z.object({
  type: z.enum(["palette", "hex", "named"]).optional().describe("Type of color data (default: palette)"),
  count: z.number().min(1).max(10).optional().describe("Number of items (default 5)"),
});

export const placehold_colors = {
  name: "placehold_colors",
  title: "Get color palette or hex codes",
  description: "Fetch color palettes, hex codes, or named colors from placehold.cloud. Use for design placeholders or theme ideas.",
  inputSchema: colorsInputSchema,
  async handler(args: z.infer<typeof colorsInputSchema>) {
    const params: Record<string, string> = {};
    if (args.type) params.type = args.type;
    if (args.count != null) params.count = String(args.count);
    const res = await placeholdFetch("/c", params);
    if (!res.ok) {
      return {
        content: [{ type: "text" as const, text: `API error: ${res.status}` }],
        isError: true,
      };
    }
    const data = await res.json();
    return {
      content: [{ type: "text" as const, text: JSON.stringify(data, null, 2).slice(0, 15000) }],
      structuredContent: typeof data === "object" ? data : { colors: data },
    };
  },
};
