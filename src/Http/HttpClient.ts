import { injectable } from "inversify";
import "reflect-metadata";
import * as WebRequest from 'web-request';
import IHttpClient from "./IHttpClient"

@injectable()
export default class HttpClient implements IHttpClient {
    async get(url: string, options?: WebRequest.RequestOptions): Promise<string> {
        let result = await WebRequest.get(url, options);

        return result.content;
    }

    async post(url: string, options?: WebRequest.RequestOptions, content?: any): Promise<string> {
        let result = await WebRequest.post(url, options, content);

        return result.content;
    }

    async put(url: string, options?: WebRequest.RequestOptions, content?: any): Promise<string> {
        let result = await WebRequest.put(url, options, content);

        return result.content;
    }

    async patch(url: string, options?: WebRequest.RequestOptions, content?: any): Promise<string> {
        let result = await WebRequest.patch(url, options, content);

        return result.content;
    }

    async del(url: string, options?: WebRequest.RequestOptions): Promise<string> {
        let result = await WebRequest.del(url, options);

        return result.content;
    }
}