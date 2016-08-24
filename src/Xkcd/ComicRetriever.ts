import { injectable, inject } from "inversify";
import { IHttpClient, IComicRetriever, TYPES } from "../types";

@injectable()
export default class ComicRetriever implements IComicRetriever {
    private httpClient: IHttpClient;

    public constructor(
        @inject(TYPES.HttpClient) httpClient: IHttpClient
    ) {
        this.httpClient = httpClient;
    }

    public async getLatestComic(): Promise<string> {
        return this.httpClient.get('http://xkcd.com').then((response) => {
            return response.content;
        });
    }
}