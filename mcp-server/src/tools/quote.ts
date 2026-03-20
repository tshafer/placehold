import { z } from "zod";
import { placeholdFetch } from "../client.js";

export const placehold_quote = {
  name: "placehold_quote",
  title: "Get a random quote",
  description: "Fetch a random inspirational quote from placehold.cloud. Use for placeholder content, demos, or inspiration. Returns a single quote object.",
  inputSchema: z.object({}),
  async handler() {
    const res = await placeholdFetch("/q");
    if (!res.ok) {
      return {
        content: [{ type: "text" as const, text: `API error: ${res.status}` }],
        isError: true,
      };
    }
    const data = await res.json();
    const text = typeof data === "object" && data.quote ? data.quote : JSON.stringify(data);
    return {
      content: [{ type: "text" as const, text }],
      structuredContent: typeof data === "object" ? data : { quote: data },
    };
  },
};
