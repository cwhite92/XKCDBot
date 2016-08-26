import { injectable, inject } from "inversify";
import "reflect-metadata";
import IHttpClient from "./IHttpClient"
import IWebRequestWrapper from "./IWebRequestWrapper";
import WebRequestWrapper from "./WebRequestWrapper";
import IRequestOptions from "./IRequestOptions";

@injectable()
export default class HttpClient implements IHttpClient {
    webRequest: WebRequestWrapper;

    constructor(
        @inject("WebRequestWrapper") webRequest: IWebRequestWrapper
    ) {
        this.webRequest = webRequest;
    }

    async get(url: string, options?: IRequestOptions): Promise<string> {
        let result = await this.webRequest.get(url, options);

        return result.content;
    }

    async post(url: string, options?: IRequestOptions, content?: any): Promise<string> {
        let result = await this.webRequest.post(url, options, content);

        return result.content;
    }

    async put(url: string, options?: IRequestOptions, content?: any): Promise<string> {
        let result = await this.webRequest.put(url, options, content);

        return result.content;
    }

    async patch(url: string, options?: IRequestOptions, content?: any): Promise<string> {
        let result = await this.webRequest.patch(url, options, content);

        return result.content;
    }

    async del(url: string, options?: IRequestOptions): Promise<string> {
        let result = await this.webRequest.del(url, options);

        return result.content;
    }
}