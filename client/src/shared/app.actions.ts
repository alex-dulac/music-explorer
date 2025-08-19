import {AppTab} from "./app-tab.type";

export class SetActiveTab {
    static readonly type = '[App] Set Active Tab';
    constructor(public payload: AppTab) {
    }
}

export class SetArtistId {
    static readonly type = '[App] Set Artist Id';
    constructor(public payload: string) {
    }
}

export class SetArtistSearchTerm {
    static readonly type = '[App] Set Artist Search Term';
    constructor(public payload: string) {
    }
}

export class SetReleaseGroupId {
    static readonly type = '[App] Set Release Group Id';
    constructor(public payload: string) {
    }
}

export class SetReleaseSearchTerm {
    static readonly type = '[App] Set Release Search Term';
    constructor(public payload: string) {
    }
}

export class SetScrobblingEnabled {
    static readonly type = '[App] Set Scrobbling Enabled';
    constructor(public payload: boolean) {
    }
}

export class ResetState {
    static readonly type = '[App] Reset State';
    constructor() {
    }
}
