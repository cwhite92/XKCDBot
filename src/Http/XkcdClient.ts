import {injectable, inject } from "inversify";
import "reflect-metadata";
import IHttpClient from "./IHttpClient";
import IXkcdClient from "./IXkcdClient";

@injectable()
export default class XkcdClient implements IXkcdClient {
    protected httpClient: IHttpClient;

    public constructor(
        @inject("HttpClient") httpClient: IHttpClient
    ) {
        this.httpClient = httpClient;
    }

    /**
     * Returns a XKCD comic found by its ID.
     *
     * @param id
     * @returns {Promise<any>}
     */
    async getComic(id: number): Promise<any> {
        let url = `http://xkcd.com/${id}/info.0.json`;

        return new Promise<any>((resolve, reject) => {
            this.httpClient.get(url).then(body => {
                resolve(JSON.parse(body));
            }).catch(error => {
                reject(error);
            });
        });
    }
}