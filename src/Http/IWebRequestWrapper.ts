import { RequestOptions, Response } from "web-request/index";

interface IWebRequestWrapper {
    get(uri: string, options?: RequestOptions): Promise<Response<string>>;
    post(uri: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    put(uri: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    patch(uri: string, options?: RequestOptions, content?: any): Promise<Response<string>>;
    head(uri: string, options?: RequestOptions): Promise<Response<void>>;
    del(uri: string, options?: RequestOptions): Promise<Response<string>>;
}

export default IWebRequestWrapper;