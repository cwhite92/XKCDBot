import { injectable } from "inversify";
import "reflect-metadata";
import { get as WRGet, post as WRPost, put as WRPut, patch as WRPatch, del as WRDel, RequestOptions, Response } from 'web-request';
import IHttpClient from "./IHttpClient"

@injectable()
export default class HttpClient implements IHttpClient {
    async get(url: string, options?: RequestOptions): Promise<Response<string>> {
        return await WRGet(url, options);
    }

    async post(url: string, options?: RequestOptions, content?: any): Promise<Response<string>> {
        return await WRPost(url, options, content);
    }

    async put(url: string, options?: RequestOptions, content?: any): Promise<Response<string>> {
        return await WRPut(url, options, content);
    }

    async patch(url: string, options?: RequestOptions, content?: any): Promise<Response<string>> {
        return await WRPatch(url, options, content);
    }

    async delete(url: string, options?: RequestOptions): Promise<Response<string>> {
        return await WRDel(url, options);
    }
}