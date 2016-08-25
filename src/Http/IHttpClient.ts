import { RequestOptions, Response } from "web-request/index";

interface IHttpClient {
    get(url: string, options?: RequestOptions): Promise<string>;
    post(url: string, options?: RequestOptions, content?: any): Promise<string>;
    put(url: string, options?: RequestOptions, content?: any): Promise<string>;
    patch(url: string, options?: RequestOptions, content?: any): Promise<string>;
    del(url: string, options?: RequestOptions): Promise<string>;
}

export default IHttpClient;