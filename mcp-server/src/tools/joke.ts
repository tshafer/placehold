import { z } from "zod";
import { placeholdFetch } from "../client.js";

export const placehold_joke = {
  name: "placehold_joke",
  title: "Get a random joke",
  description: "Fetch a random joke from placehold.cloud. Use for placeholder or demo content.",
  inputSchema: z.object({}),
  async handler() {
    const res = await placeholdFetch("/j");
    if (!res.ok) {
      return {
        content: [{ type: "text" as const, text: `API error: ${res.status}` }],
        isError: true,
      };
    }
    const data = await res.json();
    const text = typeof data === "object" && (data.joke ?? data.setup) ? (data.joke ?? `${data.setup} ${data.delivery ?? ""}`) : JSON.stringify(data);
    return {
      content: [{ type: "text" as const, text }],
      structuredContent: typeof data === "object" ? data : { joke: data },
    };
  },
};
