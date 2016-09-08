import { RequestOptions, Response } from "web-request/index";

interface IHttpClient {
    get(url: string, options?: RequestOptions): Promise<string>;
}

export default IHttpClient;