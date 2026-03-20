import { z } from "zod";
import { placeholdFetch } from "../client.js";

const loremInputSchema = z.object({
  paragraphs: z.number().min(1).max(100).optional().describe("Number of paragraphs (default 3)"),
  format: z.enum(["json", "html", "text"]).optional().describe("Response format"),
});

export const placehold_lorem = {
  name: "placehold_lorem",
  title: "Get lorem ipsum text",
  description: "Generate lorem ipsum placeholder text from placehold.cloud. Use for mock content, wireframes, or design placeholders.",
  inputSchema: loremInputSchema,
  async handler(args: z.infer<typeof loremInputSchema>) {
    const params: Record<string, string> = {};
    if (args.paragraphs != null) params.paragraphs = String(args.paragraphs);
    if (args.format) params.format = args.format;
    const res = await placeholdFetch("/l", params);
    if (!res.ok) {
      return {
        content: [{ type: "text" as const, text: `API error: ${res.status}` }],
        isError: true,
      };
    }
    const contentType = res.headers.get("content-type") ?? "";
    const isJson = contentType.includes("json");
    const data = isJson ? await res.json() : await res.text();
    const text = typeof data === "string" ? data : JSON.stringify(data);
    return {
      content: [{ type: "text" as const, text: text.slice(0, 15000) }],
      structuredContent: isJson && typeof data === "object" ? data : { text: typeof data === "string" ? data : JSON.stringify(data) },
    };
  },
};
