import { injectable, inject } from "inversify";
import "reflect-metadata";
import IHttpClient from "./IHttpClient";
import request = require("request");

@injectable()
export default class HttpClient implements IHttpClient {
    async get(url: string): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            request.get(url, (error, response, body) => {
                if (error) {
                    throw new Error(error);
                }

                resolve(body);
            });
        });
    }
}