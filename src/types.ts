import {Response, RequestOptions} from "web-request/index";

interface IHttpClient {
    get(url: string, options?: RequestOptions): Promise<Response<string>>;
    post(url: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    put(url: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    patch(url: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    delete(url: string, options?: RequestOptions): Promise<Response<string>>;
}

interface IComicRetriever {
    getLatestComic(): Promise<string>;
}

let TYPES = {
    HttpClient: Symbol('HttpClient'),
    ComicRetriever: Symbol('ComicRetriever')
};

export { IHttpClient, IComicRetriever, TYPES };