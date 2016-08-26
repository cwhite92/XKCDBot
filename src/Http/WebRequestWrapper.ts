import { injectable } from "inversify";
import "reflect-metadata";
import * as WebRequest from 'web-request';
import IWebRequestWrapper from "./IWebRequestWrapper";

@injectable()
export default class WebRequestWrapper implements IWebRequestWrapper {
    async get(uri: string, options?: WebRequest.RequestOptions): Promise<WebRequest.Response<string>> {
        return await WebRequest.get(uri, options);
    }

    async post(uri: string, options?: WebRequest.RequestOptions, content?: any): Promise<WebRequest.Response<string>> {
        return await WebRequest.post(uri, options, content);
    }

    async put(uri: string, options?: WebRequest.RequestOptions, content?: any): Promise<WebRequest.Response<string>> {
        return await WebRequest.put(uri, options, content);
    }

    async patch(uri: string, options?: WebRequest.RequestOptions, content?: any): Promise<WebRequest.Response<string>> {
        return await WebRequest.patch(uri, options, content);
    }

    async head(uri: string, options?: WebRequest.RequestOptions): Promise<WebRequest.Response<void>> {
        return await WebRequest.head(uri, options);
    }

    async del(uri: string, options?: WebRequest.RequestOptions): Promise<WebRequest.Response<string>> {
        return await WebRequest.del(uri, options);
    }
}