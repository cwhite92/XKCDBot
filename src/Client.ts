/// <reference path="../typings/index.d.ts" />

import * as WebRequest from 'web-request';

export default class Client {
    static async latestComicId() {
        return await WebRequest.get('http://xkcd.com/');
    }
}