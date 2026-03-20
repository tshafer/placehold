import { McpServer } from "@modelcontextprotocol/sdk/server/mcp.js";
import { placehold_image } from "./tools/image.js";
import { placehold_quote } from "./tools/quote.js";
import { placehold_joke } from "./tools/joke.js";
import { placehold_lorem } from "./tools/lorem.js";
import { placehold_uuid } from "./tools/uuid.js";
import { placehold_colors } from "./tools/colors.js";

export function createMcpServer(): McpServer {
  const server = new McpServer({
    name: "placehold-mcp-server",
    version: "1.0.0",
  });

  server.registerTool(placehold_image.name, {
    description: placehold_image.description,
    inputSchema: placehold_image.inputSchema,
  }, async (args: unknown) => placehold_image.handler(args as Parameters<typeof placehold_image.handler>[0]));

  server.registerTool(placehold_quote.name, {
    description: placehold_quote.description,
    inputSchema: {},
  }, () => placehold_quote.handler());

  server.registerTool(placehold_joke.name, {
    description: placehold_joke.description,
    inputSchema: {},
  }, () => placehold_joke.handler());

  server.registerTool(placehold_lorem.name, {
    description: placehold_lorem.description,
    inputSchema: placehold_lorem.inputSchema,
  }, async (args: unknown) => placehold_lorem.handler(args as Parameters<typeof placehold_lorem.handler>[0]));

  server.registerTool(placehold_uuid.name, {
    description: placehold_uuid.description,
    inputSchema: placehold_uuid.inputSchema,
  }, async (args: unknown) => placehold_uuid.handler(args as Parameters<typeof placehold_uuid.handler>[0]));

  server.registerTool(placehold_colors.name, {
    description: placehold_colors.description,
    inputSchema: placehold_colors.inputSchema,
  }, async (args: unknown) => placehold_colors.handler(args as Parameters<typeof placehold_colors.handler>[0]));

  return server;
}
