import { Kernel } from "inversify";

import IWebRequestWrapper from "./Http/IWebRequestWrapper";
import IHttpClient from "./Http/IHttpClient"
import IComicRetriever from "./Xkcd/IComicRetriever";

import WebRequestWrapper from "./Http/WebRequestWrapper";
import HttpClient from "./Http/HttpClient";
import ComicRetriever from "./Xkcd/ComicRetriever";

let kernel = new Kernel();

kernel.bind<IWebRequestWrapper>("WebRequestWrapper").to(WebRequestWrapper);
kernel.bind<IHttpClient>("HttpClient").to(HttpClient);
kernel.bind<IComicRetriever>("ComicRetriever").to(ComicRetriever);

export default kernel;