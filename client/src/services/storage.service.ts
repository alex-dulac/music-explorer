import {Injectable} from "@angular/core";

@Injectable({
    providedIn: 'root'
})
export class StorageService {

    constructor() {
    }

    setLocalStorageValue(item: string, value: string): void {
        localStorage.setItem(item, value);
    }

    getLocalStorageValue(item: string): string {
        return localStorage.getItem(item);
    }

    clearStorage(): void {
        localStorage.clear();
    }
}
