import { Kernel } from "inversify";
import {IHttpClient, TYPES, IComicRetriever} from "./types";
import Client from "./Http/Client";
import ComicRetriever from "./Xkcd/ComicRetriever";

let kernel = new Kernel();

kernel.bind<IHttpClient>(TYPES.HttpClient).to(Client);
kernel.bind<IComicRetriever>(TYPES.ComicRetriever).to(ComicRetriever);

export default kernel;