import { injectable, inject } from "inversify";
import IHttpClient from "../Http/IHttpClient"
import IComicRetriever from "./IComicRetriever";

@injectable()
export default class ComicRetriever implements IComicRetriever {
    private httpClient: IHttpClient;

    public constructor(
        @inject("HttpClient") httpClient: IHttpClient
    ) {
        this.httpClient = httpClient;
    }
}