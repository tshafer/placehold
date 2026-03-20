const BASE_URL = process.env.PLACEHOLD_BASE_URL ?? "https://placehold.cloud";

export async function placeholdFetch(path: string, params: Record<string, string> = {}): Promise<Response> {
  const url = new URL(path, BASE_URL);
  Object.entries(params).forEach(([k, v]) => url.searchParams.set(k, v));
  return fetch(url.toString(), { headers: { Accept: "application/json, image/*, */*" } });
}

export function placeholdUrl(path: string, params: Record<string, string> = {}): string {
  const url = new URL(path, BASE_URL);
  Object.entries(params).forEach(([k, v]) => url.searchParams.set(k, v));
  return url.toString();
}

export function getBaseUrl(): string {
  return BASE_URL;
}
