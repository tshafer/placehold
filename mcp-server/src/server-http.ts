#!/usr/bin/env node

import express, { Request, Response } from "express";
import { createMcpExpressApp } from "@modelcontextprotocol/sdk/server/express.js";
import { StreamableHTTPServerTransport } from "@modelcontextprotocol/sdk/server/streamableHttp.js";
import { createMcpServer } from "./server.js";

const app = createMcpExpressApp({ host: "0.0.0.0" });
app.use(express.json({ limit: "1mb" }));

app.post("/mcp", async (req: Request, res: Response) => {
  const server = createMcpServer();
  const transport = new StreamableHTTPServerTransport({ sessionIdGenerator: undefined });
  await server.connect(transport);
  res.on("close", () => {
    transport.close();
    server.close();
  });
  await transport.handleRequest(req, res, req.body);
});

const PORT = Number(process.env.PORT ?? 3000);
app.listen(PORT, () => {
  console.log(`Placehold MCP server (HTTP) listening on port ${PORT}`);
  console.log(`Connect at: http://localhost:${PORT}/mcp (or your host/mcp)`);
});
process.on("SIGINT", () => process.exit(0));
