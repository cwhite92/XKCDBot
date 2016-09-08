import { Kernel } from "inversify";

import IHttpClient from "./Http/IHttpClient"
import IComicRetriever from "./Xkcd/IComicRetriever";

import HttpClient from "./Http/HttpClient";
import ComicRetriever from "./Xkcd/ComicRetriever";

let kernel = new Kernel();

kernel.bind<IHttpClient>("HttpClient").to(HttpClient);
kernel.bind<IComicRetriever>("ComicRetriever").to(ComicRetriever);

export default kernel;