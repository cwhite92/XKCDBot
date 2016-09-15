import { Kernel } from "inversify";

import IHttpClient from "./Http/IHttpClient";
import IXkcdClient from "./Http/XkcdClient";

import HttpClient from "./Http/HttpClient";
import XkcdClient from "./Http/XkcdClient";

let kernel = new Kernel();

kernel.bind<IHttpClient>("HttpClient").to(HttpClient);
kernel.bind<IXkcdClient>("XkcdClient").to(XkcdClient);

export default kernel;