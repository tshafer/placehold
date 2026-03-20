import { z } from "zod";
import { placeholdFetch } from "../client.js";

const uuidInputSchema = z.object({
  count: z.number().min(1).max(10).optional().describe("Number of UUIDs (default 1)"),
});

export const placehold_uuid = {
  name: "placehold_uuid",
  title: "Generate UUID(s)",
  description: "Generate UUIDs from placehold.cloud. Use when you need random unique identifiers.",
  inputSchema: uuidInputSchema,
  async handler(args: z.infer<typeof uuidInputSchema>) {
    const params: Record<string, string> = {};
    if (args.count != null) params.count = String(args.count);
    const res = await placeholdFetch("/uuid", params);
    if (!res.ok) {
      return {
        content: [{ type: "text" as const, text: `API error: ${res.status}` }],
        isError: true,
      };
    }
    const data = await res.json();
    const uuids = Array.isArray(data) ? data : (data.uuids ?? (data.uuid ? [data.uuid] : [data]));
    const text = Array.isArray(uuids) ? uuids.join("\n") : JSON.stringify(data);
    return {
      content: [{ type: "text" as const, text }],
      structuredContent: { uuids: Array.isArray(uuids) ? uuids : [uuids] },
    };
  },
};
