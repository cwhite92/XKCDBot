import { injectable, inject } from "inversify";
import "reflect-metadata";
import IHttpClient from "./IHttpClient";
import request = require("request");

@injectable()
export default class HttpClient implements IHttpClient {
    async get(url: string): Promise<string> {
        return new Promise<string>((resolve, reject) => {
            request.get(url, (error, response, body) => {
                if (error || response.statusCode < 200 || response.statusCode >= 300) {
                    reject(`HTTP request failed. Status code: ${response.statusCode}. Error: ${error}`);
                }

                resolve(body);
            });
        });
    }
}