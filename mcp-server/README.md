# Placehold.cloud MCP Server

Model Context Protocol (MCP) server that exposes [placehold.cloud](https://placehold.cloud) APIs to AI assistants (Claude, Cursor, etc.). Use it to generate placeholder images, quotes, jokes, lorem ipsum, UUIDs, and colors from inside your AI workflow.

## Tools

| Tool | Description |
|------|-------------|
| `placehold_image` | Generate a placeholder image URL (size, text, bg, fg, format). |
| `placehold_quote` | Get a random inspirational quote. |
| `placehold_joke` | Get a random joke. |
| `placehold_lorem` | Generate lorem ipsum text (paragraphs, format). |
| `placehold_uuid` | Generate one or more UUIDs. |
| `placehold_colors` | Get color palettes, hex codes, or named colors. |

## Setup

```bash
cd mcp-server
npm install
npm run build
```

## Run (stdio)

For Cursor, Claude Desktop, or any MCP client that spawns the server as a subprocess:

```bash
node dist/index.js
```

Or from the project root:

```bash
node mcp-server/dist/index.js
```

## Run (HTTP — host on your server)

Run the MCP server over HTTP so clients can connect by URL (no local install for users):

```bash
npm run build
npm run start:http
```

Listens on `PORT` (default 3000). Endpoint: `POST /mcp`. Deploy behind your existing app (e.g. reverse-proxy `https://placehold.cloud/mcp` → `http://localhost:3000/mcp`) or run as a separate service. Then in Cursor/Claude, add the server by **URL** instead of command:

- **Cursor:** MCP settings → add server with URL `https://placehold.cloud/mcp` (or your host).
- **Claude Desktop:** Same — use the URL of your hosted `/mcp` endpoint.

Users get the same tools without cloning or running Node locally.

## Configuration

- **`PLACEHOLD_BASE_URL`** — Base URL for the API (default: `https://placehold.cloud`). Set to `http://localhost:8000` or your staging URL to hit a local or staging instance.
- **`PORT`** — For HTTP mode only (default: 3000). Port the HTTP server listens on.

## Adding to Cursor

In Cursor MCP settings, add a server that runs this executable:

```json
{
  "mcpServers": {
    "placehold": {
      "command": "node",
      "args": ["/absolute/path/to/placeholder/mcp-server/dist/index.js"],
      "env": {}
    }
  }
}
```

Optional: set `PLACEHOLD_BASE_URL` in `env` if you use a custom base URL.

## Adding to Claude Desktop

In Claude Desktop config (e.g. `~/Library/Application Support/Claude/claude_desktop_config.json` on macOS):

```json
{
  "mcpServers": {
    "placehold": {
      "command": "node",
      "args": ["/absolute/path/to/placeholder/mcp-server/dist/index.js"]
    }
  }
}
```

## License

Same as the parent project (MIT).
